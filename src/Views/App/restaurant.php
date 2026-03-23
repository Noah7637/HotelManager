<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

<div class="glass-card rounded-3xl p-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-black text-slate-900">Menus & Carte (Table: Menu)</h2>
        <a href="/restaurant/create" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 hover:scale-105 transition-transform">
            <i class="fas fa-plus mr-2"></i> Nouveau menu
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($menus as $menu) { ?>
        <a href="/restaurant/<?= htmlspecialchars($menu->getIdMenu()) ?>">
            <div class="border border-slate-100 rounded-3xl p-6 hover:bg-slate-50 transition-colors cursor-pointer">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-4 font-black">M<?= htmlspecialchars($menu->getIdMenu()) ?></div>
                <h4 class="font-bold text-slate-800 mb-1"><?= htmlspecialchars($menu->getMenuName()) ?></h4>
                <p class="text-xs text-slate-400 mb-4 italic"><?= htmlspecialchars($menu->getDescription()) ?></p>
                <p class="font-black text-blue-600 text-lg"><?= htmlspecialchars($menu->getPrixUn()) ?> €</p>
            </div>
        </a>
        <?php } ?>
    </div>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';