<?php $currentPath = $_SERVER['REQUEST_URI']; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjetHotel - Manager Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/style/style.css">
</head>

<body class="overflow-hidden">

    <div class="flex h-screen w-full">
        <!-- SIDEBAR -->
        <aside class="w-72 sidebar-gradient text-slate-300 flex flex-col hidden lg:flex shrink-0">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-500/20">
                        <i class="fas fa-hotel text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-black text-lg tracking-tight">ProjetHotel</h1>
                        <p class="text-[10px] text-blue-400 font-bold uppercase tracking-widest">Master Admin</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-2 overflow-y-auto custom-scrollbar">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 py-2">Menu Principal</p>
                <a href="<?= '/' ?>" id="btn-dashboard" class="nav-link w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all hover:bg-white/5 <?= $currentPath === '/' ? 'active-nav' : '' ?>">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>
                <a href="<?= '/client' ?>" id="btn-clients" class="nav-link w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all hover:bg-white/5 <?= $currentPath === '/client' ? 'active-nav' : '' ?>">
                    <i class="fas fa-users w-5"></i> Clients
                </a>
                <a href="<?= '/chambres' ?>" id="btn-chambres" class="nav-link w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all hover:bg-white/5 <?= $currentPath === '/chambres' ? 'active-nav' : '' ?>">
                    <i class="fas fa-bed w-5"></i> Chambres
                </a>

                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 py-6">Services</p>
                <a href="<?= '/restaurant' ?>" id="btn-restaurant" class="nav-link w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all hover:bg-white/5 <?= $currentPath === '/restaurant' ? 'active-nav' : '' ?>">
                    <i class="fas fa-utensils w-5"></i> Restaurant
                </a>
                <a href="<?= '/bar' ?>" id="btn-bar" class="nav-link w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all hover:bg-white/5 <?= $currentPath === '/bar' ? 'active-nav' : '' ?>">
                    <i class="fas fa-glass-martini-alt w-5"></i> Bar & Stocks
                </a>
                <a href="<?= '/infra' ?>" id="btn-infrastructures" class="nav-link w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all hover:bg-white/5 <?= $currentPath === '/infra' ? 'active-nav' : '' ?>">
                    <i class="fas fa-swimmer w-5"></i> Piscines & Salles
                </a>
            </nav>

            <div class="p-6">
                <div class="bg-slate-800/50 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">AD</div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-xs font-bold text-white truncate"><?php echo old('username'); ?></p>
                        <p class="text-[10px] text-emerald-400 font-bold uppercase tracking-widest italic">Connecté</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col overflow-hidden bg-slate-50">
            <!-- Header -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-20">
                <div class="flex-1 max-w-xl relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Rechercher une réservation, un client..." class="w-full bg-slate-100 border-none rounded-2xl py-2.5 pl-12 pr-4 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex flex-col items-end mr-4">
                        <span id="current-date" class="text-xs font-bold text-slate-800">11 Mars 2026</span>
                        <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest">Base: ProjetHotel</span>
                    </div>
                    <button class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 hover:scale-105 transition-transform">
                        <i class="fas fa-plus mr-2"></i> Nouvelle Vente
                    </button>
                </div>
            </header>

            <!-- Dynamic Section Container -->
            <div id="content-area" class="flex-1 overflow-y-auto p-8 custom-scrollbar">
                <?php echo $content; ?>
            </div>
        </main>
    </div>

</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
