@extends('layouts.master')
@section('title')
قائمة المنتجات 
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                @include('includes.massages')   
				<!-- row -->
            
              
				<div class="row">
                        	
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة منتج </a>
                                </div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>											
												<th class="border-bottom-0"> اسم المنتج</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">ملاحظات</th>
                                                <th class="border-bottom-0"> العمليات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $i=0; ?>
											@foreach ($products as $product)
											<?php  $i++ ?>
                                            <tr>
                                            <td>{{ $i}}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->section_id }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>
                                                <button class="btn btn-outline-success btn-sm" 
                                                data-pro-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                                data-description="{{ $product->description }}" data-toggle="modal"
                                                data-target="#edit_product"> تعديل</button>

                                                <button  class="btn btn-sm btn-outline-danger"
                                                data-pro-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}"
                                                 data-toggle="modal"
                                                data-target="#modaldemo9"> حذف</button>

                                            </td>
                                            
                                        </tr>
                                        @endforeach
											
											</tr>
    									
										</tbody>
									</table>

                                    {{-- Add --}}
                                    <div class="modal" id="modaldemo8">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">اضافة منتج </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('product.store') }}" method="post" autocomplete="off">
                                                     @csrf
                                                     <div class="form-group">
                                                         <label for="exampleInputEmail1">اسم منتج</label>
                                                         <input type="text" name="product_name" id="product_name"class="form-control">
                                                     </div>
                                                     <div class="form-group">
                                                        <label for="inlineformCustomSelectPref"class="my-1 mr-2">القسم </label>
                                                        <select name="section_id"id="section_id"class="form-control"required>
                                                            <option value=""selected disabled>--حدد القسم --</option>
                                                            @foreach ($sections as$section )
                                                                 <option value="{{ $section->id }}">{{$section->section_name}}</option>
 
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="exampleFromControlTextarea1">ملاحظات </label>
                                                        <textarea name="description" rows="3" id="description"class="form-control"></textarea>
                                                    </div>
                                                    <div class="model-footer">
                                                        <button type="submit" class="btn btn-success">تاكيد</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </form>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit --}}
                                    
                                      
  <!-- Modal edit-->
				            	<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                           <div class="modal-content">
                                              <div class="modal-header">
                                                 <h5 class="modal-title" id="exampleModalLabel">تعديل منتج  </h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                     <span aria-hidden="true">&times;</span>
                                                     </button>
                                                 </div>
                                            <div class="modal-body">

													<form action="product/update" method="post">
															@method('patch')
															@csrf
															<div class="form-group">
                                                                <label for="title">اسم المنتج  :</label>
																<input type="hidden" name="pro_id" id="pro_id" value=""class="form-control">
														
																<input class="form-control"name="product_name" id="product_name"type="text">
															</div>
															
																<label class="my-1 mr-2" for="inlineFormCustomSelectPerf">  ملاحظات القسم   :</label>
																<select  name="section_name" id="section_name" class="custom-select">
                                                                    @foreach ($sections as $section )
                                                                        <option value="">{{ $section->section_name }}</option>
                                                                        
                                                                    @endforeach
                                                                </select>
                                                                <div class="form-group">
                                                                    <label for="des">ملاحظات  :</label>
                                                                    <textarea name="description" id="description" class="form-control"rows="5"cols="20">
                                                                    </textarea>
                                                                </div>
														
															<div class="model-footer">
																<button type="submit" class="btn btn-success">تاكيد</button>
																<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
															</div>
															
													</form>
							</div>
						
						</div>
						</div>
					</div>


<!-- Modal delete-->
					<div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
						<div class="modal-dialog modal-dialog-centered"role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
							<h5 class="modal-title">حذف المنتج </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							</div>
						
							<form action="product/destroy"method="post">
								@method('delete')
								@csrf
							
								<div class="modal-body">
									<p>هل انت متاكد من عملية الحذف ؟</p><br>
									<input type="hidden"name="pro_id"id="pro_id"value="">
									<input class="form-control"name="product_name"id="product_name"type="text" readonly>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
									<button type="submit" class="btn btn-danger">تاكيد</button>
								</div>
								</div>
							</form>

						</div>
					</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
	$('#edit_product').on('show.bs.modal',function(event){
		var button =$(event.relatedTarget)
		var product_name=button.data('name')
		var section_name=button.data('section_name')
        var pro_id=button.data('pro_id')
		var description=button.data('description')
       
		var modal=$(this)
		modal.find('.modal-body #product_name').val(product_name);
		modal.find('.modal-body #section_name').val(section_name);
		modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #pro_id').val(pro_id);

	})
</script>

<script>
	$('#modaldemo9').on('show.bs.modal',function(event){
		var button =$(event.relatedTarget)
		var pro_id=button.data('pro_id')
		var product_name=button.data('product_name')
		var modal=$(this)
		modal.find('.modal-body #pro_id').val(pro_id);
		modal.find('.modal-body #product_name').val(product_name);
	})
</script>
@endsection