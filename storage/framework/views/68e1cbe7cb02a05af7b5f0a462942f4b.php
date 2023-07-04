<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-xl text-white message">
                    <p id="p1" data-text='Welcome, <?php echo e(auth()->user()->name); ?>'></p>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 right-0 mb-10 mr-8 z-50">
            <div id="throwBtn" class="hidden bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <p>秘密を<br>なげる</p>
            </div>
            <div id="readBtn" class="mt-8 hidden bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <p>秘密を<br>ひろう</p>
            </div>
            <div id="readStillBtn" class="mt-8 hidden bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <p>秘密を<br>よむ</p>
            </div>
        </div>
    </div>
    <script>
        <?php if(Auth::check()): ?> <!-- ユーザーが認証されているかチェック -->
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                'apiToken' => Auth::user()->createToken('Token Name')->plainTextToken // トークンの作成と取得
            ]); ?>;
        <?php endif; ?>
    </script>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
    <!-- Custom JS -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/dashboard.js'); ?>
    <?php echo $__env->make('components.bottle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/typing.js'); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/dashboard.blade.php ENDPATH**/ ?>