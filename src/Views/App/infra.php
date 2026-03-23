<?php
ob_start();


if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

<div class="space-y-8">
    <div class="glass-card rounded-3xl p-8">
        <h3 class="text-xl font-black text-slate-900 mb-6 uppercase tracking-tighter italic">Piscines de l'Hôtel</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($piscines as $piscine) { ?>
            <div class="p-6 bg-blue-50/50 border border-blue-100 rounded-3xl">
                <i class="fas fa-sun text-blue-600 mb-4"><?= $piscine->getNamePiscine() ?></i>
                <h4 class="font-bold text-slate-800"><?php  ?></h4>
                <p class="text-[10px] text-slate-500 mb-4 uppercase tracking-widest font-bold">Ouvert: <?= $piscine->getOuverture() ?> - <?= $piscine->getFermeture() ?></p>
                <div class="text-[10px] bg-white px-3 py-1 rounded-lg border border-blue-100 inline-block text-blue-600 font-bold"></div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="glass-card rounded-3xl overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 uppercase tracking-tighter">Salles de Réception</h3>
            <span class="text-[10px] bg-slate-900 text-white px-3 py-1 rounded-full font-bold">SQL: Table Salle</span>
        </div>
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-[10px] text-slate-400 uppercase font-black tracking-widest">
                <tr>
                    <th class="px-6 py-4">Nom</th>
                    <th class="px-6 py-4">Type</th>
                    <th class="px-6 py-4">Description</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            <?php foreach ($salles as $salle) { ?>           
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-bold text-slate-800"><?= $salle->getNameSalle() ?></td>
                    <td class="px-6 py-4 text-xs font-medium"><?= $salle->getType() ?></td>
                    <td class="px-6 py-4 text-xs text-slate-500"><?= $salle->getDescriptionSalle() ?></td>
                    <?php if ($salle->getStatus()) {
                        if ($salle->getStatus() === "confirmée") {
                        echo "<td class='px-6 py-4'><span class='w-2 h-2 rounded-full bg-red-500 inline-block mr-2'></span><span class='text-[10px] font-bold text-red-600'>"."réservée"."</span></td>";
                        } elseif ($salle->getStatus() === "en attente") {
                        echo "<td class='px-6 py-4'><span class='w-2 h-2 rounded-full bg-orange-500 inline-block mr-2'></span><span class='text-[10px] font-bold text-orange-600'>"."réservation en attente"."</span></td>";
                        } 
                    } else {
                        echo "<td class='px-6 py-4'><span class='w-2 h-2 rounded-full bg-emerald-500 inline-block mr-2'></span><span class='text-[10px] font-bold text-emerald-600'>"."Libre"."</span></td>";
                    } ?>
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
