<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
</head>

<h2>Documents</h2>

<a href="/document/create">Create Document</a>

<table border="1">

<tr>
<th>ID</th>
<th>Title</th>
<th>Action</th>
</tr>

@foreach($documents as $doc)

<tr>

<td>{{$doc->id}}</td>
<td>{{$doc->title}}</td>

<td>

<a href="/document/edit/{{$doc->id}}">Edit</a>

<a href="/document/print/{{$doc->id}}">Print</a>

</td>

</tr>

@endforeach

</table>
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
