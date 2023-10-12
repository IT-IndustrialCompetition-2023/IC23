<?php include("receive.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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

        /* Dropdown Button */
        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /* Dropdown button on hover & focus */
        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #3e8e41;
        }

        /* The search field */
        #myInput {
            box-sizing: border-box;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        /* The search field when it gets focus/clicked on */
        #myInput:focus {
            outline: 3px solid #ddd;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            border: 1px solid #ddd;
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
        .show {
            display: block;
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
                            <th scope="col">Status</th>
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
                                        <?php echo $data['status'] ?>
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
                <div class="dropdown">

                    <select name="kelompok1Dropdown" id="kelompok1" class="form-select mb-3" required>
                        <option value="">Pilih Kelompok</option>
                        <?php if (is_array($dataKelompok)) {
                            foreach ($dataKelompok as $kelompok) { ?>

                                <option value="<?php echo $kelompok["id"]; ?>">
                                    <?php echo $kelompok["nama"]; ?>
                                </option>
                            <?php }
                        } ?>
                    </select>
                </div>
            </div>
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
        </script>
</body>

</html>