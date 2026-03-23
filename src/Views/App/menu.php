<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}

if (empty($solo)) {
    header('Location: /restaurant');
    exit;
}
?>

<div class="space-y-6">

    <div class="flex items-center gap-3 text-sm text-slate-400 font-medium">
        <a href="/restaurant" class="hover:text-blue-600 transition-colors">
            <i class="fas fa-utensils mr-1"></i> Restaurant
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-slate-700 font-bold"><?= htmlspecialchars($solo[0]->getName()) ?></span>
    </div>

    <div class="glass-card rounded-3xl p-8">
        <div class="flex items-start justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-lg shadow-blue-200 shrink-0">
                    M<?= htmlspecialchars($solo[0]->getIdMenu()) ?>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900"><?= htmlspecialchars($solo[0]->getName()) ?></h2>
                    <p class="text-sm text-slate-400 italic mt-1"><?= htmlspecialchars($solo[0]->getDescription()) ?></p>
                </div>
            </div>
            <span class="text-3xl font-black text-blue-600 shrink-0"><?= htmlspecialchars($solo[0]->getPrixUn()) ?> €</span>
        </div>
    </div>

    <div class="glass-card rounded-3xl p-8">
        <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-4">Disponible dans</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($solo as $restau) { ?>
            <div class="border border-slate-100 rounded-2xl p-5 hover:bg-slate-50 transition-colors">
                <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black mb-3">R<?= htmlspecialchars($restau->getIdRestaurant()) ?></div>
                <p class="font-bold text-slate-800 text-sm"><?= htmlspecialchars($restau->getName()) ?></p>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="flex gap-3 justify-end">
        <a href="/restaurant" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
        <a href="/restaurant" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors">
            <i class="fas fa-pen mr-2"></i> Modifier
        </a>
        <a href="/restaurant/delete/<?= htmlspecialchars($solo[0]->getIdMenu()) ?>" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-red-500 text-white shadow-lg shadow-red-200 hover:scale-105 transition-transform">
            <i class="fas fa-trash mr-2"></i> Supprimer
        </a>
    </div>

</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';