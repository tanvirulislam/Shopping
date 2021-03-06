@extends('admin.master.master')

@section('title')
Product
@endsection

@section('body')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Catagory</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content"> 
  <div class="container-fluid">
    <div class="row">
     <div class="col-md-12">
      <div class="card" style="">
        <div class="card-header">
          <h3>Add Product</h3>
        </div>

        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Catagory Name</label>
            <select class="form-control" name="Catagory_id" id="prod_cat_id">
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->Catagory }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group" id="subcategory">
            <label>Subcatagory  Name</label>
            <select class="form-control productname" name="subcatagory_id">
              <option value="0" disabled="true" selected="true">Select Subcatagory</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">Product name</label>
            <input type="text" name="productname" class="form-control" id="exampleFormControlInput1" placeholder="Product name">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Product desceiption</label>
            <input type="text" name="productdis" class="form-control" id="exampleFormControlInput1" placeholder="Product desceiption">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Product Color</label>
            <input type="text" name="color" class="form-control" id="exampleFormControlInput1" placeholder="Product Color">
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">Product Price</label>
            <input type="number" name="price" class="form-control" id="exampleFormControlInput1" placeholder="Product Price">
          </div>

          <div class="form-group">
            <label for="exampleFormControlInput1">Product Image</label>
            <input type="file" name="picture" class="form-control" id="exampleFormControlInput1" placeholder="Product Image">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">status</label>
            <select name="status" class="form-control" id="exampleFormControlSelect1" }}>
              <option value="1">Active</option>
              <option value="0">INactive</option>

            </select>
          </div>

          <button type="submit" class="btn btn-success">Submit</button>


        </form>

      </div>
    </div>
  </div>
</div>

</section>
<script type="text/javascript">

  $(document).ready(function(){

    $('#prod_cat_id').on('change',function(){
            //console.log("hmm its change");

            var cat_id=$(this).val();
             //console.log(cat_id);
             var div=$(this).parent();


             var op=` <label for="exampleInputEmail1">Subcatagory Name</label>
             <select class="form-control productname" name="subcatagory_id" >`;

             $.ajax({
              type:'get',
              url:'{!!URL::to('findProductName')!!}',
              data:{'id':cat_id},
              success:function(data){

                  //console.log('success');

                    //console.log(data);

                    //console.log(data.length);

                   // op+='<option value="0" selected disabled>choose sub-category</option>';
                   for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].Subcatagory+'</option>';
                  }
                  // console.log(op)

                  op+= `</select>`

                  $('#subcategory').html(op);
                  // div.find('#subcategory').append(op);


                },
                error:function(){

                }

              });

           });
  });

</script>
@endsection