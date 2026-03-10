<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
</head>


<h2>Create Document</h2>

<form method="POST" action="/document/store">

@csrf

Title
<input type="text" name="title">

<br><br>

<table border="1" width="100%" id="table">

<tr>

<th>Category</th>
<th>Title</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>

</tr>

<tbody id="rows"></tbody>

</table>

<br>

<button type="button" onclick="addRow()">Add Row</button>

<button type="submit">Save</button>

</form>
<script>

let index = 0;

function addRow(){

let row = `

<tr>

<td>

<select name="rows[0][category]" class="category-select" style="width:200px">
</select>

</td>

<td>
<input type="text" name="rows[${index}][name]" class="item">
</td>

<td>
<input type="number" name="rows[${index}][qty]" class="qty">
</td>

<td>
<input type="number" name="rows[${index}][price]" class="price">
</td>

<td>
<input type="text" name="rows[${index}][total]" readonly>
</td>

</tr>

`;

document.getElementById("rows").insertAdjacentHTML("beforeend",row);

index++;

}

</script>
<script>

$('.category-select').select2({

placeholder:"Select or type category",

tags:true,   // allows new values

ajax:{

url:'/categories/search',

dataType:'json',

delay:250,

data:function(params){
return {search:params.term};
},

processResults:function(data){

return{
results:data.map(function(item){
return {id:item.id,text:item.name};
})
};

}

},

createTag:function(params){

return{
id:params.term,
text:params.term,
newTag:true
};

}

});

</script>
