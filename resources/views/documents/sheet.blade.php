<!DOCTYPE html>
<html>
<head>

<title>Document Generator</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css"/>

<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>

body{
font-family:Times New Roman;
padding:40px;
}

#sheet{
width:900px;
margin:auto;
}

button{
margin-top:20px;
padding:10px 20px;
}

</style>

</head>

<body>
<h2 style="text-align:center">NIA</h2>
<div style="margin-bottom:20px">

<label><b>Municipality:</b></label>

<select id="municipality" name="municipality">

<option value="">Select Municipality</option>

<option>Agno</option>
<option>Aguilar</option>
<option>Alaminos</option>
<option>Alcala</option>
<option>Anda</option>
<option>Asingan</option>
<option>Balungao</option>
<option>Bani</option>
<option>Basista</option>
<option>Bautista</option>
<option>Bayambang</option>
<option>Binalonan</option>
<option>Binmaley</option>
<option>Bolinao</option>
<option>Bugallon</option>
<option>Burgos</option>
<option>Calasiao</option>
<option>Dagupan</option>
<option>Dasol</option>
<option>Infanta</option>
<option>Labrador</option>
<option>Laoac</option>
<option>Lingayen</option>
<option>Mabini</option>
<option>Malasiqui</option>
<option>Manaoag</option>
<option>Mangaldan</option>
<option>Mangatarem</option>
<option>Mapandan</option>
<option>Natividad</option>
<option>Pozorrubio</option>
<option>Rosales</option>
<option>San Carlos</option>
<option>San Fabian</option>
<option>San Jacinto</option>
<option>San Manuel</option>
<option>San Nicolas</option>
<option>San Quintin</option>
<option>Santa Barbara</option>
<option>Santa Maria</option>
<option>Santo Tomas</option>
<option>Sison</option>
<option>Sual</option>
<option>Tayug</option>
<option>Umingan</option>
<option>Urbiztondo</option>
<option>Urdaneta</option>
<option>Villasis</option>

</select>

</div>



<div id="sheet"></div>

<div style="margin-top:20px;font-size:18px">

<b>Overall Total: </b>

<span id="grandTotal">0</span>

</div>

<button onclick="saveData()">Save Document</button>

<script>

const categories = @json($categories);

const container = document.getElementById('sheet');

const hot = new Handsontable(container, {

data: [],

minRows: 15,

rowHeaders: true,

colHeaders: [
'Category',
'Item Name',
'Qty',
'Price',
'Total'
],

columns: [

{
type:'autocomplete',
source:categories,
strict:false,
allowInvalid:true,
filter:false,
trimDropdown:false
},

{
type:'autocomplete',
source:[],
strict:false,
allowInvalid:true,
filter:false,
trimDropdown:false
},

{
type:'numeric'
},

{
type:'numeric'
},

{
type:'numeric',
readOnly:true
}

],

licenseKey:'non-commercial-and-evaluation',

afterChange: function(changes, source){

if(!changes || source === 'loadData' || source === 'calc') return;

changes.forEach(([row, col, oldVal, newVal])=>{

let qty = hot.getDataAtCell(row,2);
let price = hot.getDataAtCell(row,3);

if(qty && price){

let total = qty * price;

hot.setDataAtCell(row,4,total,'calc');

}

});

updateGrandTotal();

}

});
function updateGrandTotal(){

let data = hot.getData();

let grandTotal = 0;

data.forEach(row=>{

if(row[4]){

grandTotal += parseFloat(row[4]);

}

});

document.getElementById("grandTotal").innerText = grandTotal;

}
function saveData(){

let rows = hot.getData();

let municipality = document.getElementById("municipality").value;

fetch('/save-document',{

method:'POST',

headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
},

body:JSON.stringify({

municipality: municipality,

rows: rows

})

})
.then(res=>res.json())
.then(data=>{

alert("Document saved");

});

}
</script>

</body>
</html>
