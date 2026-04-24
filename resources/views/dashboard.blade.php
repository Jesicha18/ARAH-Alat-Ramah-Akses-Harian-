@extends('layouts.sidebar')

@section('title', 'ARAH Dashboard - Monitoring')

@section('content')

<link rel="icon" type="image/png" href="{{ asset('assets/img/arah-warna-hitam.png') }}">

<div class="max-w-[1400px]">
    {{-- Header --}}
    <header class="flex justify-between items-end mb-12 relative text-[#1e293b]">
        <div class="pl-12 pb-2">
            <div class="flex items-center gap-6 mb-6">
                <div class="w-16 h-16 rounded-full ring-4 ring-white shadow-md overflow-hidden border-2 border-slate-100 bg-white">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ auth()->user()->name ?? 'Jesicha' }}" alt="User">
                </div>
                <h1 class="text-5xl font-medium tracking-tight">
                    Halo, <span class="font-bold">{{ auth()->user()->name ?? 'Jesicha' }}</span> 👋
                </h1>
            </div>
            <div class="inline-flex items-center px-6 py-3 bg-white text-[#0369A1] rounded-xl text-base font-medium shadow-sm border border-blue-100">
                <div class="w-2.5 h-2.5 bg-blue-500 rounded-full animate-pulse mr-3"></div>
                <span class="opacity-70 text-sm uppercase font-bold tracking-wider">SEDANG MEMANTAU:</span>
                <span class="ml-3 uppercase tracking-widest text-[#075985] font-black">{{ $tunanetra->nama_tunanetra }}</span>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 text-[#0369A1]">
        {{-- SISI KIRI: GPS --}}
{{-- SISI KIRI: GPS --}}
        <div class="bg-[#E0F2FE] p-8 rounded-[5px] shadow-sm border border-blue-100 flex flex-col h-[580px]">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/50 rounded-[5px] shadow-inner"><i data-lucide="map-pin" class="w-6 h-6"></i></div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Live GPS Tracking</p>
                        <p class="text-xl font-bold text-[#075985]">Lokasi Terakhir</p>
                    </div>
                </div>
                {{-- TAMBAHAN KOORDINAT DI SINI --}}
                <div class="text-right">
                    <p class="text-[9px] font-black uppercase tracking-widest opacity-40">Koordinat Real-time</p>
                    <p class="text-[11px] font-bold text-[#075985] font-mono">
                        <span id="lat-display">{{ $last_data->latitude ?? '0' }}</span>, 
                        <span id="lng-display">{{ $last_data->longitude ?? '0' }}</span>
                    </p>
                </div>
            </div>
            <div id="map" class="flex-1 w-full border border-white/50 rounded-[12px] bg-slate-200 shadow-inner overflow-hidden relative"></div>
        </div>

        {{-- SISI KANAN --}}
        <div class="flex flex-col gap-8 h-[580px]">
            {{-- Heartbeat --}}
            <div class="bg-[#E0F2FE] p-8 rounded-[5px] shadow-sm border border-blue-100 flex flex-col relative overflow-hidden h-[300px]">
                <div class="flex items-center gap-4 mb-4 z-10">
                    <div class="p-3 bg-white/50 rounded-[5px] shadow-inner">
                        <i data-lucide="heart" class="fill-current w-5 h-5 text-red-500"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Detak Jantung</p>
                        <p class="text-2xl font-black text-[#075985]">
                            <span id="bpm-text">{{ $last_data->bpm ?? '--' }} BPM</span>
                            <span id="bpm-status" class="text-[10px] px-2 py-0.5 rounded-full border uppercase font-bold ml-2
                                @if(!isset($last_data->bpm)) bg-gray-100 text-gray-400 border-gray-200
                                @elseif($last_data->bpm > 100) bg-red-100 text-red-600 border-red-200
                                @elseif($last_data->bpm < 60) bg-yellow-100 text-yellow-600 border-yellow-200
                                @else bg-green-100 text-green-600 border-green-200 @endif">
                                {{ $last_data->heart_status ?? 'Normal' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="absolute bottom-2 left-0 w-full h-44 px-6">
                    <canvas id="heartRateChart"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 flex-1">
                {{-- Baterai --}}
                <div class="bg-[#E0F2FE] p-6 rounded-[5px] shadow-sm border border-blue-100 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <i data-lucide="battery" class="w-5 h-5 opacity-70"></i>
                        <p class="text-[9px] font-black uppercase tracking-widest opacity-70">Baterai</p>
                    </div>
                    <h3 class="text-3xl font-black text-[#075985] mb-4"><span id="battery-text">{{ $last_data->battery ?? '--' }}</span>%</h3>
                    <div class="w-full bg-white/50 h-2 rounded-full overflow-hidden border border-white/10">
                        <div id="battery-bar" class="bg-[#0369A1] h-full transition-all duration-1000" style="width: {{ $last_data->battery ?? 0 }}%"></div>
                    </div>
                </div>

                {{-- Notifikasi --}}
                <div class="bg-[#E0F2FE] p-6 rounded-[5px] shadow-sm border border-blue-100 flex flex-col overflow-hidden">
                    <div class="flex items-center gap-3 mb-4">
                        <i data-lucide="bell" class="w-5 h-5 opacity-70"></i>
                        <p class="text-[9px] font-black uppercase tracking-widest opacity-70">Log Notifikasi</p>
                    </div>
                    <div id="notif-display" class="flex-1 flex flex-col justify-start overflow-y-auto gap-2 pr-1 custom-scrollbar max-h-[180px]">
                        <div id="notif-empty" class="text-[10px] opacity-50 bg-white/30 p-3 rounded-lg border border-blue-50">Menunggu aktivitas rintangan...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS BAWAH --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12 text-[#0369A1]">
        <div class="bg-[#E0F2FE] p-8 rounded-[5px] shadow-sm border border-blue-100 h-[280px] flex flex-col">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-white/50 rounded-[5px] shadow-inner"><i data-lucide="bar-chart-3" class="w-6 h-6"></i></div>
                <h3 class="text-sm font-black uppercase tracking-widest opacity-70">Total Rintangan Hari ini</h3>
            </div>
            <div class="flex flex-col items-center justify-center flex-1">
                <p class="text-7xl font-black text-[#075985]" id="obstacle-total">{{ round($last_data->distance_obstacle ?? 0) }}</p>
                <p class="text-[10px] font-black opacity-40 uppercase tracking-widest mt-2">Terdeteksi</p>
            </div>
        </div>

        <div class="bg-[#E0F2FE] p-8 rounded-[5px] shadow-sm border border-blue-100 h-[280px] flex flex-col">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-white/50 rounded-[5px] shadow-inner"><i data-lucide="footprints" class="w-6 h-6"></i></div>
                <h3 class="text-sm font-black uppercase tracking-widest opacity-70">Total Langkah Harian</h3>
            </div>
            <div class="flex-1 flex flex-col items-center justify-center relative">
                <div class="relative w-32 h-32">
                    <canvas id="stepCircleChart"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-[#075985]">
                        <span id="step-count" class="text-3xl font-black">{{ number_format($last_data->step_count ?? 0) }}</span>
                        <span class="text-[8px] font-bold opacity-50 uppercase tracking-tighter">Goal 10,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-4 pb-2 relative z-10 shrink-0">
        <div class="flex flex-col items-center justify-center border-t border-slate-100 pt-3">
            <p class="text-slate-400 text-[10px] font-bold tracking-widest uppercase">
                &copy; 2026 <span class="text-[#0369A1]">ARAH</span> - Alat Ramah Akses Harian
            </p>
        </div>
    </footer>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(3, 105, 161, 0.2); border-radius: 10px; }
    #map { min-height: 400px; z-index: 10; background-color: #f1f5f9; }
    .ol-viewport { border-radius: 12px; position: absolute !important; }
    .ol-attribution { display: none; }
    @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    #notif-display > div:first-child:not(#notif-empty) { animation: slideIn 0.4s ease-out forwards; }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v9.2.4/ol.css">
<script src="https://cdn.jsdelivr.net/npm/ol@v9.2.4/dist/ol.js"></script>

<script>
// Ambil angka rintangan awal dari PHP biar punya patokan bandingin rintangan baru
if (typeof lastObsCount === 'undefined') { 
    var lastObsCount = {{ round($last_data->distance_obstacle ?? 0) }}; 
}
var beatPhase = 0;
var lastFrameTime = 0;
window.currentRealBpm = {{ $last_data->bpm ?? 0 }}; 

document.addEventListener("DOMContentLoaded", function() {
    if (window.lucide) lucide.createIcons();

    // ===== MAP INIT (Sekali Saja) =====
    const initLat = parseFloat("{{ $last_data->latitude ?? -6.228 }}");
    const initLng = parseFloat("{{ $last_data->longitude ?? 106.611 }}");
    const initCoord = ol.proj.fromLonLat([initLng, initLat]);
    
    window.markerFeature = new ol.Feature({ geometry: new ol.geom.Point(initCoord) });
    window.markerFeature.setStyle(new ol.style.Style({
        image: new ol.style.Circle({
            radius: 9, fill: new ol.style.Fill({ color: '#0369A1' }),
            stroke: new ol.style.Stroke({ color: '#ffffff', width: 3 })
        })
    }));

    window.olMap = new ol.Map({
        target: 'map',
        layers: [ 
            new ol.layer.Tile({ source: new ol.source.OSM() }), 
            new ol.layer.Vector({ source: new ol.source.Vector({ features: [window.markerFeature] }) }) 
        ],
        view: new ol.View({ center: initCoord, zoom: 17 }),
        controls: []
    });

    // Fix ukuran map saat pertama load
    setTimeout(() => { window.olMap.updateSize(); }, 500);

    // ===== HEART CHART INIT =====
    const ctx = document.getElementById('heartRateChart').getContext('2d');
    let existingChart = Chart.getChart("heartRateChart");
    if (existingChart) existingChart.destroy();

    window.heartRateChart = new Chart(ctx, {
        type: 'line',
        data: { 
            labels: Array(60).fill(""), 
            datasets: [{ 
                data: Array(60).fill(0), 
                borderColor: '#0369A1', borderWidth: 3, fill: true,
                backgroundColor: 'rgba(3, 105, 161, 0.1)', tension: 0.4, pointRadius: 0 
            }] 
        },
        options: { 
            responsive: true, maintainAspectRatio: false, animation: false,
            plugins: { legend: { display: false } },
            scales: { 
                x: { display: false }, 
                y: { min: 0, max: 160, ticks: { stepSize: 40, color: '#94a3b8' } } 
            }
        }
    });

    // ===== STEP CHART INIT =====
    const stepCtx = document.getElementById('stepCircleChart').getContext('2d');
    if (stepCtx) {
        let existingStep = Chart.getChart("stepCircleChart");
        if (existingStep) existingStep.destroy();
        window.stepCircleChart = new Chart(stepCtx, {
            type:'doughnut',
            data:{ 
                datasets:[{ 
                    data:[{{ $last_data->step_count ?? 0 }}, 10000], 
                    backgroundColor:['#075985','#E2E8F0'], borderWidth: 0, cutout:'85%' 
                }] 
            },
            options:{ plugins: { legend: { display: false } } }
        });
    }

    // Jalankan Loop Animasi Grafik
    requestAnimationFrame(animateChart);
    
    // Update Data Halus tiap 3 detik (PENGGANTI RELOAD)
    updateDashboard(); 
    setInterval(updateDashboard, 1000); 
});

async function updateDashboard() {
    try {
        const response = await fetch('/api/latest-sensor/{{ $tunanetra->id }}');
        const resData = await response.json();
        const data = resData.latest;
        if (!data) return;

        // Update Teks Koordinat
        document.getElementById('lat-display').innerText = data.latitude;
        document.getElementById('lng-display').innerText = data.longitude;

        // Update Posisi Peta (Smooth Glide)
        const newLat = parseFloat(data.latitude);
        const newLng = parseFloat(data.longitude);
        if (!isNaN(newLat) && !isNaN(newLng) && newLat !== 0) {
            const newCoord = ol.proj.fromLonLat([newLng, newLat]);
            window.markerFeature.getGeometry().setCoordinates(newCoord);
            window.olMap.getView().animate({ center: newCoord, duration: 1000 });
        }

        // Update BPM & Baterai
        window.currentRealBpm = parseInt(data.bpm || 0);
        document.getElementById('bpm-text').innerText = (window.currentRealBpm > 0 ? window.currentRealBpm : '--') + " BPM";
        document.getElementById('battery-text').innerText = Math.round(data.battery ?? 0) + "";
        document.getElementById('battery-bar').style.width = (data.battery ?? 0) + "%";

        // === LOG NOTIFIKASI RINTANGAN (SANGAT KRUSIAL) ===
        const currentObs = Math.floor(Number(data.distance_obstacle) || 0);
        
        // Munculkan notif jika angka rintangan bertambah
        if (lastObsCount !== null && currentObs > lastObsCount) {
            showNotif(); 
        }
        lastObsCount = currentObs; // Update patokan terakhir
        document.getElementById('obstacle-total').innerText = currentObs;
        
        // Update Steps
        if (window.stepCircleChart) {
            window.stepCircleChart.data.datasets[0].data[0] = data.step_count || 0;
            window.stepCircleChart.update('none');
            document.getElementById('step-count').innerText = (data.step_count || 0).toLocaleString();
        }
    } catch (e) { console.error("Background update paused: " + e); }
}

function showNotif() {
    const logContainer = document.getElementById('notif-display');
    if (!logContainer) return;
    const emptyHint = document.getElementById('notif-empty');
    if (emptyHint) emptyHint.style.display = 'none';

    const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const newDiv = document.createElement('div');
    newDiv.className = "bg-white p-3 rounded-lg mb-2 shadow-sm border-l-4 border-red-500 animate-slide-in";
    newDiv.innerHTML = `
        <div class="flex justify-between items-center">
            <span class="text-[10px] font-black text-red-600 uppercase tracking-tighter flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-ping"></span> Rintangan
            </span>
            <span class="text-[9px] font-bold opacity-40">${time}</span>
        </div>
        <p class="text-[11px] font-medium text-[#075985]">Objek terdeteksi di jalur.</p>
    `;
    logContainer.prepend(newDiv);
    
    // Batasi log biar gak kepenuhan (max 5)
    if (logContainer.children.length > 6) logContainer.removeChild(logContainer.lastElementChild);
}

function animateChart(timestamp) {
    if (!window.heartRateChart) return;
    if (timestamp - lastFrameTime < 40) { requestAnimationFrame(animateChart); return; }
    lastFrameTime = timestamp;

    const chartData = window.heartRateChart.data.datasets[0].data;
    const bpm = window.currentRealBpm || 0;
    chartData.shift();
    
    let nextValue;
    if (bpm === 0) {
        nextValue = 0; beatPhase = 0;
    } else {
        let beatInterval = Math.max(10, Math.floor(1000 / bpm)); 
        if (beatPhase === 3) nextValue = bpm + (bpm * 0.4); 
        else if (beatPhase === 4) nextValue = bpm - (bpm * 0.2); 
        else nextValue = bpm + (Math.random() - 0.5) * 4;
        beatPhase = (beatPhase > beatInterval) ? 0 : beatPhase + 1;
    }
    chartData.push(nextValue);
    window.heartRateChart.update('none');
    requestAnimationFrame(animateChart);
}
</script>
@endpush