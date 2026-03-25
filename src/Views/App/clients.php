<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

<div class="glass-card rounded-3xl p-8">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-2xl font-black text-slate-900">Base de données Clients</h2>
            <p class="text-slate-400 text-sm italic">Synchronisé avec la table 'Client'</p>
        </div>
        <a href="/client/create"><button class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2">
            <i class="fas fa-user-plus"></i> Importer
        </button></a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($clients ?? [] as $client) { ?>
        <a href="/client/<?= htmlspecialchars($client->getId()) ?>">
        <div class="p-6 border border-slate-100 rounded-3xl bg-white hover:shadow-xl hover:shadow-slate-200/50 transition-all group">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 flex items-center justify-center rounded-2xl font-black text-xl">
                    <?= htmlspecialchars(mb_strtoupper(mb_substr($client->getPrenom(), 0, 1) . mb_substr($client->getNom(), 0, 1))) ?>
                </div>
                <div>
                    <h4 class="font-black text-slate-800 text-lg"><?= htmlspecialchars($client->getPrenom()) ?> <?= htmlspecialchars($client->getNom()) ?></h4>
                    <p class="text-xs text-blue-500 font-bold">#<?= htmlspecialchars($client->getId()) ?></p>
                </div>
            </div>
            <div class="space-y-3 pt-4 border-t border-slate-50 text-sm">
                <div class="flex items-center gap-2 text-slate-500"><i class="fas fa-envelope text-xs"></i> <?= htmlspecialchars($client->getEmail()) ?></div>
                <div class="flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-widest"><i class="fas fa-lock"></i> MDP : ••••••••</div>
            </div>
        </div>
        </a>
        <?php } ?>
    </div>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';