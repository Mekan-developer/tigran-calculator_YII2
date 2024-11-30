<?php

namespace app\controllers;

use app\models\user\UserRecord;
use app\models\user\UserSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * UserController implements the CRUD actions for UserRecord model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'roles' => ['admin'],
                            'allow' => true
                        ],
                        [
                            'actions' => ['profile-update'],
                            'roles' => ['manager'],
                            'allow' => true
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all UserRecord models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearchModel();
        $dataProvider = $searchModel->search($this->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRecord model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserRecord();

        if ($this->request->isPost) {
            // Load the posted data and check if the model is valid
            if ($model->load($this->request->post()) && $model->save()) {
                // Get the ID of the newly created user
                $userId = $model->id;

                // Get the role manager or admin
                $rbac = Yii::$app->authManager;
                $role = $rbac->getRole('manager');  // You can use 'admin' here if needed

                // Ensure the role exists before attempting to assign it
                if ($role !== null) {
                    // Assign the role to the user
                    $rbac->assign($role, $userId);

                    // Check if the assignment was successful
                    $authAssignments = (new \yii\db\Query())
                        ->select(['user_id', 'item_name'])
                        ->from('auth_assignment')
                        ->where(['user_id' => $userId])
                        ->all();

                    if (!empty($authAssignments)) {
                        Yii::$app->session->setFlash('success', 'User created and role assigned successfully.');
                    } else {
                        Yii::$app->session->setFlash('error', 'Role assignment failed.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Role not found.');
                }

                // Redirect to the 'view' page for the created user
                return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues(); // Set default values if it's a new user
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing UserRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionProfileUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect('/calculation-base');
        }

        return $this->render('profileUpdate', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // Find the user record
        $user = $this->findModel($id);
    
        // Delete the associated role(s) from auth_assignment table
        $rbac = Yii::$app->authManager;
        $rbac->revokeAll($user->id);  // This will remove all roles for the user
    
        // Delete the user record from the user table
        $user->delete();
    
        // Redirect to the index page after deletion
        return $this->redirect(['index']);
    }
    

    /**
     * Finds the UserRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserRecord::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
