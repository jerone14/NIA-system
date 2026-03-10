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

<h2 style="text-align:center">TITLE OF NIA</h2>

<div id="sheet"></div>

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
allowInvalid:true
},

{
type:'autocomplete',
source:[],
strict:false,
allowInvalid:true
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

if(!changes || source === 'loadData') return;

changes.forEach(([row, prop, oldVal, newVal])=>{

// When category changes → load item suggestions
if(prop === 0){

fetch('/items/'+newVal)

.then(res=>res.json())

.then(data=>{

hot.setCellMeta(row,1,'source',data);

});

}

// Auto compute total
let qty = hot.getDataAtCell(row,2);
let price = hot.getDataAtCell(row,3);

if(qty && price){

hot.setDataAtCell(row,4, qty * price,'calc');

}

});

}

});

</script>
<script>

function saveData(){

let rows = hot.getData();

fetch('/save-document',{

method:'POST',

headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
},

body:JSON.stringify({
rows:rows
})

})
.then(res=>res.json())
.then(data=>{

alert("Document saved successfully");

});

}

</script>
</body>
</html>
