<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

<div class="glass-card rounded-3xl overflow-hidden">
    <div class="p-8 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <h2 class="text-2xl font-black">Gestion du Parc Hôtelier</h2>
        <p class="text-blue-200 text-sm opacity-80">Inventaire en temps réel de la table 'Chambre'</p>
    </div>
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach ($chambres ?? [] as $chambre) { ?>
        <div class="border border-slate-200 rounded-3xl overflow-hidden group hover:border-blue-400 transition-all">
            <div class="h-40 bg-slate-200 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <span class="absolute top-4 left-4 px-3 py-1 bg-white/20 backdrop-blur-md border border-white/30 text-white text-[10px] font-black rounded-lg uppercase tracking-widest">
                    <?= htmlspecialchars($chambre->getCategorie()) ?>
                </span>
                <div class="absolute bottom-4 left-4 text-white">
                    <h4 class="font-bold"><?= htmlspecialchars($chambre->getName()) ?></h4>
                    <p class="text-[10px] opacity-80"><?= htmlspecialchars($chambre->getDescription()) ?></p>
                </div>
            </div>
            <div class="p-5 flex justify-between items-center bg-white">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase">Tarif / Nuit</p>
                    <p class="text-xl font-black text-slate-800"><?= htmlspecialchars($chambre->getPrix()) ?> €</p>
                </div>
                <div class="text-right">
                    <?php if ($chambre->getOccupe() === 1) { ?>
                        <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest bg-red-50 text-red-600 border border-red-100">
                            Occupé
                        </span>
                    <?php } else { ?>
                        <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">
                            Libre
                        </span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';