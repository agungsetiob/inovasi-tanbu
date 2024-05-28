<section class="page-section bg-inovation portfolio" id="riset-list">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">Riset Daerah Tanah Bumbu</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-atom fa-spin"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-9 p-1">
                <div class="table-responsive bg-white p-3 rounded shadow" hx-history="false">
                    <table class="table table-borderless table-hover table-striped" id="tabel-riset" width="100%" cellspacing="0">
                        <thead class="bg-primary">
                            <tr>
                                <th width="50%">Judul Kajian</th>
                                <th width="45%">SKPD</th>
                                <th width="5%">Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Server-side dataTable gan -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3 p-1">
                <div class="p-3 bg-white rounded shadow">
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Keywords">
                    </div>
                    <div class="mb-3">
                        <label for="yearFilter" class="form-label">Tahun:</label>
                        <select id="yearFilter" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            <!-- Dynamically populated options will go here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="skpdFilter" class="form-label">SKPD:</label>
                        <select id="skpdFilter" class="form-select" data-searchable="true">
                            <option value="">-- Semua SKPD --</option>
                            <!-- Dynamically populated options will go here -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var dataTable;
    $(document).ready(function () {
        $.ajax({
            url: 'api/riset',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                populateFilters(response.data);

                dataTable = $('#tabel-riset').DataTable({
                    data: response.data,
                    columns: [
                        {
                            data: 'judul',
                            render: function (data, type, row) {
                                return '<a class="text-dark" href="' + row.url + '">' + data + '</a>';
                            }
                        },
                        {
                            data: 'skpd.nama',
                            render: function (data, type, row) {
                                return '<a class="text-dark" href="' + row.url + '">' + data + '</a>';
                            }
                        },
                        {
                            data: 'tahun',
                            className: 'text-center',
                            render: function (data, type, row) {
                                return '<a class="text-dark" href="' + row.url + '">' + data + '</a>';
                            }
                        },
                    ],
                    pageLength: 5,
                    initComplete: function (settings, json) {
                        htmx.process('#tabel-riset');
                    },
                });

                $('.dt-search').addClass('d-none');

                // Filter event listeners
                $('#yearFilter').on('change', function () {
                    dataTable.column(2).search(this.value).draw();
                });

                $('#skpdFilter').on('change', function () {
                    dataTable.column(1).search(this.value).draw();
                });

                $('#searchInput').on('keyup', function () {
                    dataTable.search(this.value).draw();
                });
            },
            error: function (error) {
                console.error('Error fetching riset:', error);
            },
        });

        document.body.addEventListener("reloadTable", function (evt) {
            dataTable.ajax.reload(function () {
                htmx.process('#tabel-riset');
            }, false);
        });

        function populateFilters(data) {
            var years = new Set();
            var skpds = new Set();

            data.forEach(function (item) {
                years.add(item.tahun);
                skpds.add(item.skpd.nama);  // Correctly access 'skpd.nama'
            });

            years.forEach(function (year) {
                $('#yearFilter').append(new Option(year, year));
            });

            skpds.forEach(function (skpd) {
                $('#skpdFilter').append(new Option(skpd, skpd));
            });

            const skpdFilter = new UseBootstrapSelect(document.getElementById('skpdFilter'));
            const yearFilter = new UseBootstrapSelect(document.getElementById('yearFilter'));
        }
    });
</script>