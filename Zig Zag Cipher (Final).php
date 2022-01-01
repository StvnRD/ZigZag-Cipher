<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <title>Kriptografi Algoritma Rail Fence</title>
</head>

<!-- Styling CSS -->
<style>
    #page {
        padding-left : 20px;
    }

    #tblA {
        border-collapse: collapse;
    }
    #tblA td, #tblA th {
        border : 1px solid #ddd;
    }

    #tblA th {
        padding-left : 4px;
    }

    #tblA td {
        padding-left : 4px;
        padding-top : 5px;
        padding-right : 25px;
    }

    #tblA tr:nth-child(even){background-color: #f2f2f2;}

    #btEcr {
        background : pink;
        padding : 5px;
        font-size : 110%;
        font-weight : bold;
        border : none;
        border-radius : 3px;
    }
    
    #btEcr:hover {
        cursor : pointer;
        color : white;
        background : darkred;
        width : 110%;
        border-radius : 50px;
        transition : 1s;
    }

    #btDcr {
        background : lightgreen;
        padding : 5px;
        font-size : 110%;
        font-weight : bold;
        border : none;
        border-radius : 3px;
    }
    
    #btDcr:hover {
        cursor : pointer;
        color : white;
        background : darkgreen;
        width : 110%;
        border-radius : 50px;
        transition : 1s;
    }
    

    #tblB td, #tblB th, #tblC td, #tblC th {
        padding-top : 5px;
        padding-right : 15px;
        
    }

    #inptext {
        width : 400px;
    }

    #inpbaris, #inpblock {
        width : 50px;
    }

    #hasil1 {
        font-weight : bold;
        font-size : 120%;
        color : darkred;
    }
    
    #hasil2 {
        font-weight : bold;
        font-size : 130%;
        color : darkgreen;
    }

</style>


<!-- Membuat tabel anggota kelompok -->
<body id="page">
    <h2>TUGAS KRIPTOGRAFI - KELOMPOK 5</h2>
    <h4>Anggota kelompok :</h4>
    <table id="tblA">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Kelas</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Rulli Aji Gunawan</td>
            <td>311910675</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Steven Ryan Darmawan</td>
            <td>311910524</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Syukur Yakub</td>
            <td>311910696</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Zanevianti Sugirlawati</td>
            <td>311910493</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Riwan Irosucipto Manurung</td>
            <td>311910500</td>
            <td>TI.19.C.1</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Rivaldi Hamzah</td>
            <td>311910656</td>
            <td>TI.19.C.1</td>
        </tr>
        
    </table>

    <br><br>

    <h3>Metode Enkripsi Plaintext Dengan Algoritma Rail Fence Chiper (ZigZag)</h3>

    <table id=tblB>
        <form method="post">
            <tr>
                <td>
                    <label >
                        Input Plaintext
                    </label>
                </td>
                <td>
                    <input type="text" name="plaintext" id="inptext" />
                </td>
            </tr>
            <tr>
                <td><label for="barisE">
                        Input Jumlah Baris
                    </label>
                </td>
                <td><input type="integer" name="barisE" id="inpbaris"/>
                </td>
            </tr>  
            <tr>
                <td><label for="blockE">
                        Input Jumlah Block
                    </label>
                </td>
                <td><input type="integer" name="blockE" id="inpblock"/>
                </td>
            </tr>  
            <tr>
                <td>
                    <label>
                        <input type="submit" name="kirimE" value="Enkripsi" id="btEcr">
                    </label>
                </td>
            </tr>         
        </form>
    </table>

    

    <?php

    # Mendklarasikan string plaintext, jumlah elemen per block split, dan kedalaman baris ketika botton Enkripsi di klik
        if (isset($_POST["kirimE"])) {        
            $plaintext = $_POST["plaintext"];
            $split = $_POST["blockE"];
            $barisE = $_POST["barisE"];

        # Mendeklarasikan string alfabet dan angka sebagai kandidat huruf pengganti spasi dan huruf penambah
            $alfa = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
            
         # Mengambil hanya unique character dari plaintext dan merubah menjadi uppercase
            $plaintext_array = str_split($plaintext);
            $unique = array_unique($plaintext_array);
            $plaintext_unique = implode("",$unique);
            $plaintext_unique = strtoupper(str_replace(" ","",$plaintext_unique));
            $len_unique = strlen($plaintext_unique);
            
        # Hanya untuk test array
            // print_r($plaintext_array)."<br>";
            // print_r($unique)."<br>";
            // echo $plaintext_unique."<br>";
            // echo $len_unique."<br>";
            // echo $alfa."<br>";

        # Menhapus elemen alfabet jika elemen tersebut digunakan dalam plain text
            for($i=0; $i<$len_unique; $i++) {
                if(strpos($alfa,$plaintext_unique[$i]) >= 0) {
                $alfa = str_replace($plaintext_unique[$i],"",$alfa);
                }
            }    
            // echo $alfa."<br>"; 
            
        # Mendeklarasikan huruf pengganti spasi dari elemen pertama alafabet yang tidak digunakan dalam plain text (index-0)
        # Mendeklarasikan huruf penambah dari elemen kedua alafabet yang tidak digunakan dalam plain text (index-1)
            $space = $alfa[0];
            $plus = $alfa[1];
        
        # Menggabungkan huruf pengganti spasi dan huruf penambah sebagai identifier ketika proses dekripsi nanti
            $spaceadd = $space .= $plus;

        # Menambahkan hasil penggabungan diatas diawal plaintext, menghitung panjang hasil penggabungan, dan menghitung modulo terhadap nilai split block yang diinput
            $plaintext =  strtoupper($spaceadd .= $plaintext);
            $len = strlen($plaintext);
            $mod = $len % $split;

        # Menambahkan plaintext dengan huruf penambah untuk melengkapi jumlah karakter supaya nilai mod terhadap split nya menjadi nol jika nilai modulo tidak sama dengan nol
            if ($mod > 0) {
                $add = $split - $mod;
                for ($i = 0; $i < $add; $i++) {
                    $plaintext .= $plus;
                }
            }

            echo "<br>";
        
        # Membuat array matriks kosong sesuai dengan panjang seluruh hasil gabungan plain text dan kedalaman baris zigzag yang diinput
            $mtr = array();
            $kolE = strlen($plaintext);
            for ($i = 0; $i < $barisE; $i++) {
                for ($j = 0; $j < $kolE; $j++) {
                    $mtr[$i][$j] = "";
                }
            } 

            // echo $plaintext."<br>";
            // echo strlen($plaintext)."<br>";

        # Menempatkan tiap huruf plain text secara zigzag pada array mtr            
            $row = 0;
            $check = 0;
            $kolE = strlen($plaintext);
            for ($i = 0; $i < $kolE; $i++) {
                if ($check == 0) {

                # Merubah spasi dengan huruf pengganti spasi
                    if ($plaintext[$i] == " ") {
                        $plaintext[$i] = $space;
                        $mtr[$row][$i] = $plaintext[$i];
                        $row++;
                        if ($row == $barisE) {
                            $check = 1;
                            $row--;
                        }
                    }
                    else {
                        $plaintext[$i] = $plaintext[$i];
                        $mtr[$row][$i] = $plaintext[$i];
                        $row++;
                        if ($row == $barisE) {
                            $check = 1;
                            $row--;
                        }
                    }
                }

                # Merubah spasi dengan huruf pengganti spasi    
                elseif ($check == 1) {
                    $row--;
                    if ($plaintext[$i] == " ") {
                        $plaintext[$i] = $space;
                        $mtr[$row][$i] = $plaintext[$i];
                        if ($row == 0) {
                            $check = 0;
                            $row = 1;
                        }
                    }
                    else {
                        $plaintext[$i] = $plaintext[$i];
                        $mtr[$row][$i] = $plaintext[$i];
                        if ($row == 0) {
                            $check = 0;
                            $row = 1;
                        }
                    }
                    
                }
            }

        // Menggabungkan semua elemen array mtr dalam satu string baru ct secara horizontal
            $ct = array();
            for ($i = 0; $i < $barisE; $i++) {
                for ($j = 0; $j < $kolE; $j++) {
                    if ($mtr[$i][$j] != " "){
                        array_push($ct, $mtr[$i][$j]);
                    }   
                }
            }

        # Memisahkan karakter menjadi block-block sesuai yang diinput dan berikan delimiter (pemisah)
            $ct = str_split(strtoupper(join("",$ct)),$split); 
            $ct2 = array();
            for ($i = 0; $i < count($ct); $i++) {
                array_push($ct2, $ct[$i]);
            }
            $ct = strtoupper(implode(" - ",$ct2));  
        }
        
    ?>
    
    <!-- Menampilkan hasil enkripsi -->
    <p>
        <?php 
            if (isset($_POST["kirimE"])) {
                $plain = $_POST["plaintext"];
                echo "Hasil enkripsi dari ' ".$plain." ' dengan baris kunci '".$barisE."' adalah :"; 
            }         
         ?> 
    </p>  
    <p id="hasil1">
         <?php 
         if (isset($_POST["kirimE"])) {
            echo $ct."<br>";
         }         
         ?>
    </p>

    <hr><br>    

    <h3>Metode Dekripsi Chipertext Dengan Algoritma Rail Fence Chiper (ZigZag)</h3>

    <table id=tblC>
        <form method="post">
            <tr>
                <td>
                    <label for="chipertext">
                        Input Chipertext
                    </label>
                </td>
                <td><input type="text" name="chipertext" id="inptext"/>
                </td>
            </tr>
            <tr>
                <td><label for="barisD">
                        Input Jumlah Baris
                    </label>
                </td>
                <td>
                    <input type="integer" name="barisD" id="inpbaris"/>
                </td>
            </tr>  
            <tr>
                <td>
                    <label>
                        <input type="submit" name="kirimD" value="Dekripsi" id="btDcr">
                    </label>
                </td>
            </tr>           
        </form>
    </table>

    <?php
        if (isset($_POST["kirimD"])) {

        # Membuat array matriks kosong sesuai dengan panjang chiper text setelah dihilangkan delimiter pemisah block nya dan baris kunci yang diinputkan
            $mtr = array();
            $chipertext = $_POST["chipertext"];     
            $chipertext = str_replace(" - ","",$chipertext);
            $kolD = strlen($chipertext);
            $barisD = $_POST["barisD"];
            for ($i = 0; $i < $barisD; $i++) {
                for ($j = 0; $j < $kolD; $j++) {
                    $mtr[$i][$j] = "";
                }
            } 

        # Menempatkan tiap huruf plain text secara zigzag pada array mtr     
            $row = 0;
            $check = 0;
            $kolD = strlen($chipertext);
            for ($i = 0; $i < $kolD; $i++) {
                if ($check == 0) {
                    $mtr[$row][$i] = $chipertext[$i];
                        $row++;
                        if ($row == $barisD) {
                            $check = 1;
                            $row--;
                    }
                }
                    
                elseif ($check == 1) {
                    $row--;
                    $mtr[$row][$i] = $chipertext[$i];
                        if ($row == 0) {
                            $check = 0;
                            $row = 1;
                    }
                    
                }
            }
            

        // Reordering atau penempatan ulang elemen chiper text pada array
        // Menggunakan temporary string, menambahkan elemen array zigzag ke dalam temporary string
        // Jika nilai elemen adalah kosong, maka dilanjutkan ke looping selanjutnya
        // Jika nilai elemen tidak kosong, maka nilainya digantikan oleh karakter dari chipertext index ke-"nilai order"
        // Dan jika terpenuhi, maka nilai order akan terjadi increament
            $order = 0;
            for ($i = 0; $i < $barisD; $i++) {
                for ($j = 0; $j < $kolD; $j++) {
                    $temp = "";
                    $temp .= $mtr[$i][$j];
                    if ($temp == "") {
                        continue;
                    }
                    else {
                        $mtr[$i][$j] = $chipertext[$order];
                        $order++;
                    }
                }
            }

        # Menggabungkan semua elemen array mtr kedalam satu string baru pt secara horizontal
            $pt = "";
            $row = 0;
            $check = 0;
            for ($i = 0; $i < $kolD; $i++) {
                if ($check == 0) {
                    $pt .= $mtr[$row][$i];
                    $row++;
                    if ($row == $barisD) {
                        $check = 1;
                        $row--;
                    }
                }
                elseif ($check == 1) {
                    $row--;
                    $pt .= $mtr[$row][$i];
                    if ($row == 0) {
                        $check = 0;
                        $row = 1;
                    }
                }
            }

        # Mendeklarasikan huruf pengganti spasi dari elemen pertama hasil dekripsi chiper text (index-0)
        # Mendeklarasikan huruf penambah dari elemen kedua hasil dekripsi chiper text (index-1)
        # Menghilagkan 2 elemen pertama dari hasil dekripsi awal
        # Merubah huruf pengganti spasi dengan spasi dan menghapus huruf panambah
            $space = $pt[0];
            $plus = $pt[1];
            $pt = substr($pt,2);
            $pt = str_replace($space," ",$pt);
            $pt = str_replace($plus,"",$pt);
            $pt = ucfirst(strtolower($pt));

        }
    ?>  

    <!-- Menampilkan hasil dekripsi akhir-->
    <p>
        <?php 
            if (isset($_POST["kirimD"])) {
                $chiper = $_POST["chipertext"];
                echo "Hasil dekripsi dari ' ".$chiper." ' adalah :"; 
            }
         
         ?> 
    </p>  
    <p id="hasil2">
         <?php 
         if (isset($_POST["kirimD"])) {
            echo $pt."<br>"; 
         }         
         ?>
    </p>

</body>
</html>