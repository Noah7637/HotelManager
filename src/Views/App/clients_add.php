<?php
ob_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth/login/');
}
?>

<div class="space-y-6">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-3 text-sm text-slate-400 font-medium">
        <a href="/client" class="hover:text-blue-600 transition-colors">
            <i class="fas fa-users mr-1"></i> Clients
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-slate-700 font-bold">Nouveau client</span>
    </div>

    <!-- Flash messages -->
    <?php if (isset($success)): ?>
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-2xl px-5 py-3">
            <i class="fas fa-check-circle"></i>
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-2xl px-5 py-3">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <form action="/client/insert" method="POST">

        <div class="glass-card rounded-3xl p-8 space-y-6">
            <h2 class="text-2xl font-black text-slate-900">Créer un client</h2>

            <!-- Nom + Prénom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nom</label>
                    <input type="text" name="nom" placeholder="Ex : Dupont"
                        value="<?= htmlspecialchars(old('nom')) ?>"
                        class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 text-sm font-medium focus:ring-2 focus:ring-blue-500 outline-none <?= isset($errors['nom']) ? 'ring-2 ring-red-400' : '' ?>">
                    <?php if (isset($errors['nom'])): ?>
                        <p class="text-xs text-red-500 mt-1 ml-1"><?= htmlspecialchars($errors['nom']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Prénom</label>
                    <input type="text" name="prenom" placeholder="Ex : Jean"
                        value="<?= htmlspecialchars(old('prenom')) ?>"
                        class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 text-sm font-medium focus:ring-2 focus:ring-blue-500 outline-none <?= isset($errors['prenom']) ? 'ring-2 ring-red-400' : '' ?>">
                    <?php if (isset($errors['prenom'])): ?>
                        <p class="text-xs text-red-500 mt-1 ml-1"><?= htmlspecialchars($errors['prenom']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Adresse e-mail</label>
                <input type="email" name="email" placeholder="Ex : jean.dupont@gmail.com"
                    value="<?= htmlspecialchars(old('email')) ?>"
                    class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 text-sm font-medium focus:ring-2 focus:ring-blue-500 outline-none <?= isset($errors['email']) ? 'ring-2 ring-red-400' : '' ?>">
                <?php if (isset($errors['email'])): ?>
                    <p class="text-xs text-red-500 mt-1 ml-1"><?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Mot de passe -->
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Mot de passe</label>
                <input type="password" name="mdp" placeholder="••••••••"
                    class="w-full bg-slate-100 border-none rounded-2xl py-3 px-5 text-sm font-medium focus:ring-2 focus:ring-blue-500 outline-none <?= isset($errors['mdp']) ? 'ring-2 ring-red-400' : '' ?>">
                <?php if (isset($errors['mdp'])): ?>
                    <p class="text-xs text-red-500 mt-1 ml-1"><?= htmlspecialchars($errors['mdp']) ?></p>
                <?php endif; ?>
            </div>

        </div>

        <!-- Actions -->
        <div class="flex gap-3 justify-end mt-6">
            <a href="/client" class="px-5 py-2.5 rounded-xl text-sm font-bold border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Annuler
            </a>
            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-lg shadow-blue-200 hover:scale-105 transition-transform">
                <i class="fas fa-plus mr-2"></i> Créer le client
            </button>
        </div>

    </form>

</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';