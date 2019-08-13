@extends('admin.layouts.app')
@section('title','Edit Product')
@section('content')
@php 
$cat_data = Helpers::categoryList();
$color_data = Helpers::colorList();
$size_data = Helpers::sizeList();
$prd_price_det = Helpers::productPriceList($prd_data->id);
@endphp
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admin-vendors/js/admin-custom-validation.js') }}"></script>
<style>
.imageThumb {
    max-height: 75px;
    border: 1px solid;
    padding: 1px;
    cursor: pointer;
}
.img_ {

    float: left;
    padding-left: 6px;

}
.pip {
    display: inline-block;
    margin: 10px 10px 0 0;
}
.remove {
    display: block;
    text-align: center;
    cursor: pointer;
}

.remove i{color:red; position: relative;
    right: -9px;}

</style>


<div class="container-fluid page-body-wrapper">
  @include('admin.includes.admin-sidebar')
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body my-ac">
            <h5 class="display-5">Edit Product</h5>
            <!--.text-danger.text-warning .text-info-->
            <div style="height:25px;"> @include('admin.includes.error-mesg') </div>
            
             {!! Form::model($prd_data, ['method' => 'PATCH','name' => 'frm_edit','id' => 'frm_edit','data-toggle'=>"validator", 'role' => 'form','files'=>true,'autocomplete'=>'off','route' => ['manage-products.update', $prd_data->id]]) !!}
             
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category<span class="text-danger">*</span></label>
              <div class="col-sm-5">
               {!! Form::select('prd_cat_id',$cat_data,old('cat_id',$prd_data->prd_cat_id),  ['id' => 'prd_cat_id','required', 'class'=>'form-control','placeholder'=>'Select Category']) !!} 
               
                <div class="error-hgt">@if ($errors->has('prd_cat_id'))<p class="text-warning">{{ $errors->first('prd_cat_id') }}</p>@endif</div> 
              </div>
            </div>
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Product Name<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::text('prd_name',$prd_data->prd_name,array('id' => 'prd_name','required', 'class'=>'form-control','placeholder'=>'')) !!}
                
                <div class="error-hgt">@if ($errors->has('prd_name'))<p class="text-warning">{{ $errors->first('prd_name') }}</p>@endif</div> 
              </div>
            </div>
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Upload Product Photo<span class="text-danger">*</span></label>
              <div class="col-sm-5">
                {!! Form::file('prd_photo', ['id' => 'prd_photo','onchange'=>'','class'=>'form-control file-upload-info','placeholder'=>'Upload Product Photo','accept'=>"jpg,png"]) !!}
                
                <div class="error-hgt">@if ($errors->has('prd_photo'))<p class="text-warning">{{ $errors->first('prd_photo') }}</p>@endif</div> 
              </div>
            </div>
            
            <div class="col-md-2">
              <img src="{{ asset('public/product-photo/'.$prd_data->prd_photo) }}" style="width:100%;">
            </div>
            
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">
              Upload Optional Product Photo
              <span style="color:#F00">Note : Use CTRL & + key to upload multiple Photos</span>
              </label>
              <div class="col-sm-5">
              {!! Form::file('opt_images[]', ['multiple','id' => 'opt_images','onchange'=>"",'','class'=>'form-control','accept'=>"jpeg,jpg,png"]) !!}
              <div class="error-hgt">@if ($errors->has('opt_images')) <p class="text-warning">{{ $errors->first('opt_images') }}</p> @endif </div>
              </div>
                
              <div class="pip" style="width:100%; padding-left:15px;">
                <div class="row" id="opt_images_div"></div>
			  </div>
            </div>
            
            
            
            <div class="mul_image">
            <div class="row">
              @foreach($prd_data->productOptionalImages as $productImage)
              <div class="col-md-2">
              <a href="javascript:void(0);" id="prod_mul_image_{{ $productImage->id }}" class="text-center" style="display:inline-block;"><img src="{{ asset('public/product-photo/'.$productImage->opt_images) }}" style="width:100%;"><br><i class="fa fa-trash" onclick="return delOptImages({{ $productImage->id }});"></i></a>
              </div>
              @endforeach
              </div>
            </div>
            <div class="clearfix form-group"></div>

                            
                            
                            
            <div class="form-group">
              <label>Product Details<span class="text-danger">*</span></label>
              {!! Form::textarea('prd_details',$prd_data->prd_details,array('id' => 'prd_details','required', 'class'=>'ckeditor form-control','size' => '30x5','placeholder'=>'')) !!}
              
              <div class="error-hgt">@if ($errors->has('prd_details')) <p class="text-warning">{{ $errors->first('prd_details') }}</p> @endif</div>
            </div>
            
            
           
            
           <div class="form-group row">
             {!! Form::hidden('cs',$prd_data->prd_cs_opt,array('id' => 'cs')) !!}
             <br />

              
            </div>
            
            <div class="form-group col-md-8">
              <label style="margin-left:-10px;"><strong>Set Product Price @if($prd_data->prd_cs_opt == 1)color / size wise @endif</strong></label>
              
              
              <div style="width:80px; float:right; text-align:right; <?php if($prd_data->prd_cs_opt==0){?>display:none; <?php } ?>" id="disp_pm">
                <img src="{{ asset('public/images/plus.gif') }}" width="16" height="16"  onClick="addProductPrice();" style="cursor:pointer;"/>&nbsp;
                <img src="{{ asset('public/images/minus.gif') }}" width="16" height="16" onClick="delProductPrice();" style="cursor:pointer;"/>
              </div>
               
             
              <div class="prod-specif-row">
                <div class="row">
                  <div class="col-md-4"><label>Color <span style="color:#F00;">*</span></label></div>
                  <div class="col-md-4"><label>Size <span style="color:#F00;">*</span></label></div>
                  <div class="col-md-4"><label>Price <span style="color:#F00;"></span></label></div>
                </div>
                
                @php $j=1; @endphp
                @foreach ($prd_price_det as $prd_res)
                <div class="_row clearfix" id="row_to_clone{{ $j }}" style="margin-bottom:5px;">
                  <div class="row">
                    <div class="col-md-4">
                     <select class="form-control" id="color_id{{ $j }}" name="color_id{{ $j }}" <?php if($prd_res->color_id==''){ ?> disabled <?php } ?> required>
                        <option  value="">--Select Color--</option>
                        @foreach($color_data as $color_key => $color_val)
                        <option  value="{{ $color_key }}" <?php if($prd_res->color_id==$color_key) { echo "selected"; }?>>{{ $color_val }}</option>
                        @endforeach
                     </select>
                    </div>
                    
                    <div class="col-md-4">
                      <select class="form-control" id="size_id{{ $j }}" name="size_id{{ $j }}" <?php if($prd_res->size_id==''){ ?> disabled <?php } ?> required>
                          <option  value="">--Select Size--</option>
                          @foreach($size_data as $size_key => $size_val)
                          <option  value="{{ $size_key }}" <?php if($prd_res->size_id==$size_key) { echo "selected"; }?>>{{ $size_val }}</option>
                          @endforeach
                      </select>
                    </div>
                    
                    <div class="col-md-4">
                      <input type="text" class="form-control" name="prd_price{{ $j }}" id="prd_price{{ $j }}" value="{{ number_format($prd_res->prd_price,2,'.','') }}" onKeyUp="validatePrice(this);" placeholder="Sales Price" maxlength="10" required>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="db_record{{ $j }}" id="db_record{{ $j }}" value="{{ $prd_res->id }}">
                @php $j++; @endphp
                @endforeach
                
                <input type="hidden" name="prd_price_row_count" id="prd_price_row_count" value="{{ $j-1 }}">
                @php for($s=$j;$s<=10;$s++){ @endphp
                <div class="_row clearfix" id="row_to_clone{{$s}}" style="display:none;margin-bottom:5px;">
                  <div class="row">
                    <div class="col-md-4">
                      <select class="form-control" id="color_id{{ $s }}" name="color_id{{ $s }}">
                      <option  value="">--Select Color--</option>
                        @foreach($color_data as $colors_key => $color_val)
                        <option  value="{{ $colors_key }}">{{ $color_val }}</option>
                        @endforeach
                      </select>
                    </div>
                      
                    <div class="col-md-4">
                      <select class="form-control" id="size_id{{ $s }}" name="size_id{{ $s }}">
                        <option  value="">--Select Size--</option>
                        @foreach($size_data as $sizes_key => $size_val)
                        <option  value="{{ $sizes_key }}">{{ $size_val }}</option>
                        @endforeach
                      </select>
                    </div>
                                           
                    <div class="col-md-4">
                      <input type="text" class="form-control" name="prd_price{{ $s }}" id="prd_price{{ $s }}" value="" onKeyUp="validatePrice(this);">
                    </div>
                  </div>
                </div>
              @php } @endphp
              </div>
            </div>
               
          
              
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Title<span class="text-danger">*</span>:</label>
            <div class="col-sm-5">
              {!! Form::textarea('prd_meta_title',$prd_data->prd_meta_title,array('id' => 'prd_meta_title','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
            <div class="error-hgt">@if ($errors->has('prd_meta_title')) <p class="text-warning">{{ $errors->first('prd_meta_title') }}</p> @endif </div>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Keyword:</label>
            <div class="col-sm-5">
             {!! Form::textarea('prd_meta_keyword',$prd_data->prd_meta_keyword,array('id' => 'prd_meta_keyword','', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
             
           <div class="error-hgt">@if ($errors->has('prd_meta_keyword')) <p class="text-warning">{{ $errors->first('prd_meta_keyword') }}</p> @endif </div>
            </div>
          </div>
          
          
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Meta Description:</label>
            <div class="col-sm-5">
            {!! Form::textarea('prd_meta_description',$prd_data->prd_meta_description,array('id' => 'prd_meta_description','', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
            
           <div class="error-hgt">@if ($errors->has('prd_meta_description')) <p class="text-warning">{{ $errors->first('prd_meta_description') }}</p> @endif </div>
            </div>
          </div>
          {{ Form::submit('Update', array('class' => 'btn btn-success mr-2')) }}
          <a href="{{ URL::to('administrator/manage-products') }}" class="btn btn-light"><i class="fa fa-backward"></i> Back to List </a>
           
           {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    @include('admin.includes.admin-footer')
  </div>
</div>
@endsection