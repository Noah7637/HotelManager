<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <?php foreach ($bars as $bar) { ?>
    <div class="glass-card p-8 rounded-3xl">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-black text-slate-800 uppercase italic tracking-tighter"><i class="fas fa-wine-bottle text-purple-600 mr-2"></i> <?= htmlspecialchars($bar->getName()) ?> </h3>
            <i class="fas fa-sync text-slate-300"></i>
        </div>
        <div class="space-y-8">
            <div>
                <?php foreach ($boissonsBar[$bar->getIdBar()] as $boisson) { ?>
                <div class="flex justify-between items-end mb-2">
                    <span class="font-bold text-slate-700"><?= htmlspecialchars($boisson->getBoissonName()) ?>  |  <?= htmlspecialchars($boisson->getPrixUnBoisson()) ?> €</span>
                    <span class="text-[10px] font-black text-slate-400"><?= htmlspecialchars($boisson->getQteStock()) ?> / 100 UNITES</span>
                </div>
                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 transition-all duration-1000" style="width: 100%"></div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="bg-slate-900 rounded-3xl p-8 text-white relative overflow-hidden shadow-2xl shadow-slate-900/40">
        <div class="relative z-10">
            <h3 class="text-xl font-black mb-8">Dernières Commandes Client</h3>
            <div class="space-y-4">
                <?php foreach ($commandes as $commande) { ?>
                <div class="p-4 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center"><i class="fas fa-cocktail"></i></div>
                        <div>
                            <p class="text-sm font-bold"><?= htmlspecialchars($commande->getClientBoissonQte()) ?>x <?= htmlspecialchars($commande->getBoissonName()) ?></p>
                            <p class="text-[10px] text-slate-500">Client: <?= htmlspecialchars($commande->getClientPrenom()) ?> <?= htmlspecialchars($commande->getClientNom()) ?></p>
                        </div>
                    </div>
                    <div class="font-black"><?= htmlspecialchars($commande->getPrixCommande()) ?> €</div>
                </div>
                <?php } ?>
            </div>
        </div>
        <i class="fas fa-glass-cheers absolute -right-10 -bottom-10 text-white/5 text-[200px] rotate-12"></i>
    </div>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';