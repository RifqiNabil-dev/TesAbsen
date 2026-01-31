

<?php $__env->startSection('title', 'Edit Lokasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto bg-white rounded-lg shadow border border-gray-200">

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-bold text-gray-800">
            Edit Lokasi
        </h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="<?php echo e(route('admin.locations.update', $location)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- NAMA LOKASI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Lokasi <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="<?php echo e(old('name', $location->name)); ?>"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 focus:border-blue-500"
                >
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea
                    name="description"
                    rows="3"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 focus:border-blue-500"
                ><?php echo e(old('description', $location->description)); ?></textarea>
            </div>

            <!-- MAP -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Pilih Titik Lokasi Magang <span class="text-red-500">*</span>
                </label>

                <div id="map" class="w-full h-72 rounded border"></div>
                <p class="text-xs text-gray-500 mt-1">
                    Klik pada peta untuk menentukan titik lokasi absensi
                </p>
            </div>

            <!-- KOORDINAT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Latitude
                    </label>
                    <input
                        type="number"
                        step="0.0000001"
                        name="latitude"
                        id="latitude"
                        value="<?php echo e(old('latitude', $location->latitude)); ?>"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm"
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Longitude
                    </label>
                    <input
                        type="number"
                        step="0.0000001"
                        name="longitude"
                        id="longitude"
                        value="<?php echo e(old('longitude', $location->longitude)); ?>"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm"
                    >
                </div>
            </div>

            <!-- RADIUS ABSENSI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Radius Absensi (meter) <span class="text-red-500">*</span>
                </label>
                
                <input
                    type="number"
                    name="radius"
                    id="radius"
                    value="<?php echo e(old('radius', $location->radius)); ?>"
                    min="10"
                    step="1"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 focus:border-blue-500"
                >
                
            </div>

            <!-- STATUS -->
            <div class="mb-6">
                <label class="inline-flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        <?php echo e(old('is_active', $location->is_active) ? 'checked' : ''); ?>

                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center">
                <a
                    href="<?php echo e(route('admin.locations.index')); ?>"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold
                           text-white hover:bg-blue-700"
                >
                    Simpan
                </button>
            </div>
        </form>

        <script>
            const defaultLat = <?php echo e(old('latitude', $location->latitude) ?? -7.9721340); ?>;
            const defaultLng = <?php echo e(old('longitude', $location->longitude) ?? 112.6221959); ?>;
            const defaultRadius = <?php echo e(old('radius', $location->radius) ?? 50); ?>;
            
            const map = L.map('map').setView([defaultLat, defaultLng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker;
            let radiusCircle;

            function updateMap(lat, lng, radius) {
                if (marker) map.removeLayer(marker);
                if (radiusCircle) map.removeLayer(radiusCircle);

                marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup('Titik lokasi absensi')
                    .openPopup();

                radiusCircle = L.circle([lat, lng], {
                    radius: radius,
                    color: 'blue',
                    fillOpacity: 0.2
                }).addTo(map);
            }

            // default marker
            updateMap(defaultLat, defaultLng, defaultRadius);
            document.getElementById('latitude').value = defaultLat.toFixed(7);
            document.getElementById('longitude').value = defaultLng.toFixed(7);

            map.on('click', function (e) {
                const lat = e.latlng.lat.toFixed(7);
                const lng = e.latlng.lng.toFixed(7);
                const radius = document.getElementById('radius').value;

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                updateMap(lat, lng, radius);
            });

            // Update radius realtime
            document.getElementById('radius').addEventListener('input', function () {
                const lat = document.getElementById('latitude').value;
                const lng = document.getElementById('longitude').value;

                if (lat && lng) {
                    updateMap(lat, lng, this.value);
                }
            });
        </script>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/locations/edit.blade.php ENDPATH**/ ?>