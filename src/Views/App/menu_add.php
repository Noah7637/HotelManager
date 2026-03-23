<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

<div class="space-y-6">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-3 text-sm text-slate-400 font-medium">
        <a href="/restaurant" class="hover:text-blue-600 transition-colors">
            <i class="fas fa-utensils mr-1"></i> Restaurant
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-slate-700 font-bold">Nouveau menu</span>
    </div>

    <!-- Formulaire -->
    <form action="/restaurant/insert" method="POST">

        <div class="glass-card rounded-3xl p-8 space-y-6">
            <h2 class="text-2xl font-black text-slate-900">Créer un menu</h2>

            <!-- Nom -->
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nom du menu</label>
                <input type="text" name="nom" placeholder="Ex : Menu du Terroir" value="<?= htmlspecialchars(old('nom')) ?>"
                    class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 text-sm font-medium focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Description</label>
                <textarea name="description" rows="3" placeholder="Ex : Entrée + Plat + Dessert au choix..."
                    class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 text-sm font-medium focus:ring-2 focus:ring-blue-500 outline-none resize-none"><?= htmlspecialchars(old('description')) ?></textarea>
            </div>

            <!-- Prix -->
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Prix (€)</label>
                <input type="number" name="prix" step="0.01" min="0" placeholder="Ex : 32.00" value="<?= htmlspecialchars(old('prix')) ?>"
                    class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 text-sm font-medium focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Restaurants -->
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Disponible dans</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <?php foreach ($restos as $resto) { ?>
                    <label class="flex items-center gap-3 border border-slate-100 rounded-2xl p-4 cursor-pointer hover:bg-slate-50 transition-colors">
                        <input type="checkbox" name="restaurants[]" value="<?= htmlspecialchars($resto->getIdRestaurant()) ?>" class="accent-blue-600 w-4 h-4">
                        <div>
                            <p class="text-sm font-bold text-slate-800"><?= htmlspecialchars($resto->getName()) ?></p>
                        </div>
                    </label>
                    <?php } ?>
                </div>
            </div>

        </div>

        <!-- Actions -->
        <div class="flex gap-3 justify-end mt-6">
            <a href="/restaurant" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Annuler
            </a>
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-lg shadow-blue-200 hover:scale-105 transition-transform">
                <i class="fas fa-plus mr-2"></i> Créer le menu
            </button>
        </div>

    </form>

</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';