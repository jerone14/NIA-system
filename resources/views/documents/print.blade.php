<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
</head>

<style>

body{
font-family:Times New Roman;
padding:40px;
}

table{
width:100%;
border-collapse:collapse;
}

td,th{
border:1px solid black;
padding:5px;
}

</style>

<h2 style="text-align:center">TITLE OF NIA</h2>

<br>

<table>

<tr>

<th>Title</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>

</tr>

@foreach($document->rows as $row)

<tr>

<td>{{$row->name}}</td>
<td>{{$row->qty}}</td>
<td>{{$row->price}}</td>
<td>{{$row->total}}</td>

</tr>

@endforeach

</table>

<script>
window.print();
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
