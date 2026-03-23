<?php
ob_start();
?>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 flex items-center justify-center p-6">
    <div class="w-full max-w-md">

        <div class="glass-card rounded-3xl overflow-hidden">

            <!-- Header -->
            <div class="p-8 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                <div class="w-12 h-12 bg-white/15 border border-white/20 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-hotel text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-black">S'inscrire</h2>
                <p class="text-blue-200 text-sm opacity-80">Créer votre accès à la gestion hôtelière</p>
            </div>

            <!-- Separator -->
            <div class="h-1 bg-gradient-to-r from-blue-400 via-blue-500 to-transparent"></div>

            <!-- Body -->
            <div class="p-8 bg-white">
                <form action="/auth/register/" method="post" class="flex flex-col gap-5">

                    <!-- Username -->
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center border border-slate-200 rounded-2xl overflow-hidden hover:border-blue-300 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                            <label for="username" class="px-4 py-3 border-r border-slate-100 text-slate-400 text-sm flex items-center">
                                <i class="fas fa-user-tie"></i>
                            </label>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                value="<?php echo old('username'); ?>"
                                placeholder="Nom d'utilisateur"
                                class="flex-1 px-4 py-3 outline-none text-slate-800 text-sm font-medium placeholder:text-slate-300 bg-transparent"
                            >
                        </div>
                        <span class="text-xs text-red-500 font-semibold px-1"><?php echo error('username'); ?></span>
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center border border-slate-200 rounded-2xl overflow-hidden hover:border-blue-300 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                            <label for="inputPassword" class="px-4 py-3 border-r border-slate-100 text-slate-400 text-sm flex items-center">
                                <i class="fas fa-key"></i>
                            </label>
                            <input
                                id="inputPassword"
                                type="password"
                                name="password"
                                value="<?php echo old('password'); ?>"
                                placeholder="Mot de passe"
                                class="flex-1 px-4 py-3 outline-none text-slate-800 text-sm font-medium placeholder:text-slate-300 bg-transparent"
                            >
                            <button id="btnPassword" type="button" class="px-4 py-3 text-slate-400 hover:text-blue-500 transition-colors">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <!-- Barre de force du mot de passe -->
                        <div class="h-1 rounded-full bg-slate-100 overflow-hidden mt-1">
                            <div id="strengthFill" class="h-full rounded-full transition-all duration-300" style="width: 0%;"></div>
                        </div>
                        <span class="text-xs text-red-500 font-semibold px-1"><?php echo error('password'); ?></span>
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center border border-slate-200 rounded-2xl overflow-hidden hover:border-blue-300 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                            <label for="inputPasswordConfirm" class="px-4 py-3 border-r border-slate-100 text-slate-400 text-sm flex items-center">
                                <i class="fas fa-key"></i>
                            </label>
                            <input
                                id="inputPasswordConfirm"
                                type="password"
                                name="passwordConfirm"
                                value="<?php echo old('passwordConfirm'); ?>"
                                placeholder="Confirmer le mot de passe"
                                class="flex-1 px-4 py-3 outline-none text-slate-800 text-sm font-medium placeholder:text-slate-300 bg-transparent"
                            >
                            <button id="btnPasswordConfirm" type="button" class="px-4 py-3 text-slate-400 hover:text-blue-500 transition-colors">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <span class="text-xs text-red-500 font-semibold px-1"><?php echo error('passwordConfirm'); ?></span>
                        <span class="text-xs text-red-500 font-semibold px-1"><?php echo error('confirm'); ?></span>
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="mt-2 w-full py-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-black rounded-2xl hover:from-blue-700 hover:to-blue-900 hover:-translate-y-0.5 active:translate-y-0 transition-all shadow-lg shadow-blue-500/30 text-sm uppercase tracking-widest"
                    >
                        Créer mon compte
                    </button>

                </form>

                <!-- Footer link -->
                <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                    <p class="text-slate-400 text-sm">
                        Vous avez déjà un compte ?
                        <a href="/auth/login" class="text-blue-600 font-black hover:text-blue-800 transition-colors">Identifiez-vous !</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    var btnPass   = document.getElementById("btnPassword");
    var inputPass = document.getElementById("inputPassword");
    btnPass.onclick = function () {
        if (inputPass.type === "password") {
            inputPass.type = "text";
            btnPass.innerHTML = '<i class="far fa-eye-slash"></i>';
        } else {
            inputPass.type = "password";
            btnPass.innerHTML = '<i class="far fa-eye"></i>';
        }
    };

    var btnPassConf   = document.getElementById("btnPasswordConfirm");
    var inputPassConf = document.getElementById("inputPasswordConfirm");
    btnPassConf.onclick = function () {
        if (inputPassConf.type === "password") {
            inputPassConf.type = "text";
            btnPassConf.innerHTML = '<i class="far fa-eye-slash"></i>';
        } else {
            inputPassConf.type = "password";
            btnPassConf.innerHTML = '<i class="far fa-eye"></i>';
        }
    };

    // Barre de force du mot de passe
    inputPass.addEventListener("input", function () {
        var val   = inputPass.value;
        var score = 0;
        if (val.length >= 8)            score++;
        if (/[A-Z]/.test(val))          score++;
        if (/[0-9]/.test(val))          score++;
        if (/[^A-Za-z0-9]/.test(val))   score++;

        var fill    = document.getElementById("strengthFill");
        var widths  = ["25%", "50%", "75%", "100%"];
        var colors  = ["#ef4444", "#f97316", "#eab308", "#22c55e"];
        if (val.length === 0) {
            fill.style.width      = "0%";
            fill.style.background = "";
        } else {
            fill.style.width      = widths[score - 1] || "25%";
            fill.style.background = colors[score - 1] || "#ef4444";
        }
    });
</script>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
