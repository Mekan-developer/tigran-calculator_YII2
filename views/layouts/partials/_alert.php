<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 10000)" 
        x-show="show" 
        class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg"
        role="alert"
    >
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4h2v2H9v-2zm0-8h2v6H9V6z" clip-rule="evenodd" />
            </svg>
            <span><?= Yii::$app->session->getFlash('success') ?></span>
            <button 
                type="button" 
                class="ml-auto -mr-1 text-green-700 hover:text-green-900" 
                @click="show = false"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
<?php endif; ?>