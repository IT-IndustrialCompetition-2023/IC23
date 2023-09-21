<?php include("receive.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <style>
        .container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: nowrap;
            padding-top: 5%;
        }

        .content {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .inputBox {
            padding-top: 5%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="tablaBox">
                <table id="kelompok1Table">
                    <thead>
                        <tr>
                            <th scope="col" style="display: none;">#</th>
                            <th scope="col">Nama kelompok</th>
                            <th scope="col">Post</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (is_array($fetchData)) {
                            $i = 1;
                            foreach ($fetchData as $data) {

                                ?>
                                <tr>
                                    <td style="display: none;">
                                        <?php echo $data['id_kelompok'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['namaKelompok'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['namaPost'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['timestamp'] ?>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="inputBox">
                <select name="kelompok1Dropdown" id="kelompok1" class="form-select mb-3" required>
                    <option value="">Kelompok 1</option>
                    <?php if (is_array($dataKelompok)) {
                        foreach ($dataKelompok as $kelompok) { ?>

                            <option value="<?php echo $kelompok["id"]; ?>">
                                <?php echo $kelompok["nama_kelompok"]; ?>
                            </option>
                        <?php }
                    } ?>
                </select>
            </div>
        </div>

        <!-- <div class="content">
            <div class="tablaBox">
                <table id="kelompok2Table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama kelompok</th>
                            <th scope="col">Post</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //if (is_array($fetchData)) {
                        //  $i = 1;
                        //foreach ($fetchData as $data) {
                        
                        ?>
                                <tr>
                                    <td>
                                        <?php // echo $i++; ?>
                                    </td>
                                    <td>
                                        <?php // echo $data['namaKelompok'] ?>
                                    </td>
                                    <td>
                                        <?php // echo $data['namaPost'] ?>
                                    </td>
                                    <td>
                                        <?php // echo $data['timestamp'] ?>
                                    </td>
                                </tr>
                            <?php // }
                            // } ?>
                    </tbody>
                </table>
            </div>
            <div class="inputBox">
                <select name="kelompok2" id="kelompok2" class="form-select mb-3" required>
                    <option value="">Kelompok 2</option>
                    <?php // if (is_array($dataKelompok)) {
                    // foreach ($dataKelompok as $kelompok) { ?>
                            <option value="<?php // echo $kelompok["id"]; ?>">
                                <?php // echo $kelompok["nama_kelompok"]; ?>
                            </option>
                        <?php // }
                        // } ?>
                </select>
            </div>
        </div>
    </div> -->
    </div>

    <!-- Data Tables -->
    <script>
        $(document).ready(function () {
            $('#kelompok1Table').DataTable({
                "paging": false, // Disable pagination
                "scrollY": "250px", // Enable vertical scrolling
                "scrollX": true, // Enable horizontal scrolling
                "autoWidth": false, // Disable automatic column width calculation
                "lengthChange": false, // Hide the length change control
                "searching": false, // Disable searching
            });
        });

        $(document).ready(function () {
            $('#kelompok2Table').DataTable({
                "pageLength": 3,
                "scrollY": "250px",
                "scrollX": true, // Enable horizontal scrolling
                "autoWidth": false, // Disable automatic column width calculation
                "lengthChange": false,
                "searching": false,
            });
        });
    </script>

    <!-- Search  -->
    <script>
        const dropDown1 = document.getElementById('kelompok1');
        const table1 = document.getElementById('kelompok1Table').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        dropDown1.addEventListener('change', function () {
            const selectedValue = this.value;
            for (let i = 0; i < table1.length; i++) {
                const kelompok1Cell = table1[i].getElementsByTagName('td')[0];
                const cellContent = kelompok1Cell.textContent;
                if (cellContent.includes(selectedValue)) {
                    table1[i].style.display = '';
                } else {
                    table1[i].style.display = 'none';
                }
            }
        });


        // $('#kelompok1').on('change', (event) => {
        //   console.log("test");
        //   const nrp = $('#nRPMahasiswa').val();
        //   $.ajax({
        //     url: '/panitia/pelanggaran/TambahPelanggaran/getMahasiswa',
        //     method: 'GET',
        //     success: function (response) {
        //       $('#nrpValue').text(response.nrp);
        //       $('#namaValue').text(response.nama);
        //       $('#jurusanValue').text(response.jurusan);
        //     }
        //   })
        // })
    </script>
</body>

</html>