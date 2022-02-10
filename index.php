<?php

$limit =50;
$from = $_GET["from"]?? "";
$to =$_GET["to"] ?? "";
$offset = $_GET['offset'] ?? 0;

$q = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$from}&offset={$offset}&resource_id=d499d2f0-b1ea-4ba2-9600-2c701b03bd4a&limit={$limit}"));

$data= $q->result->records;

?>
<style>
    h2 {
        text-align: center;
    }
    table {
        border-collapse: collapse;
        border: 1px solid black;
        width:70%;
        margin-left: auto;
        margin-right: auto;
    }
    th, td{
        text-align: center;
        border: 1px solid black;
    }
</style>

<h2>Covid statistika</h2>

<form method="get" action="/">
    From: <input type="date" name="from" >
    To : <input type="date" name="to" >
    <button type="submit">Filter</button>

</form>

<table>

    <tr>
        <th>Datums</th>
        <th>Testu skaits</th>
        <th>Apstiprināto gadījumu skaits</th>
    </tr>
    <?php foreach ($data as $item) {?>


    <tr>
        <td>
                <?php echo date("Y-m-d", strtotime($item->Datums)) ; ?>
            </td>
        <td>
                <?php echo $item->TestuSkaits; ?>
            </td>
        <td>
                <?php echo $item->ApstiprinataCOVID19InfekcijaSkaits; ?>
            </td>

    </tr>

    <?php } ?>
</table>

<form method="get" action="/">
    <?php if ($offset > 0) { ?>
        <button type="submit" name ="offset" value = "<?php echo $offset - $limit ?>"> << Previous </button>
    <?php } ?>
    <?php if (count($data) >= $limit) { ?>
        <button type="submit" name ="offset" value = "<?php echo $offset + $limit ?>"> Next >> </button>
    <?php } ?>
