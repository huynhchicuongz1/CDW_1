@extends('front-end.masterpage.master')
@section('content')

    <main> 
       <div class="container">
                <section>
                <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="form-heading">1. List Province</h4>
                                    <div class="form-group">
                                        <label class="control-label">Province: </label>
										<select class="form-control" name="province" id="province">
                                            <option value="-1">---Select Province---</option>
                                        @foreach($sql as $row)
											<option value="{{ $row->province_id }}">{{ $row->province_name }}</option>
                                        @endforeach
										</select>                                      
                                    </div>
                                </div>
                    </div>
                    <h2> Danh sách các sân bay của Tỉnh: </h2>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row alert" >
                                            <div class="col-sm-3">
                                                <label class="control-label"> Tên Sân Bay</label>                                       
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Mã Sân Bay</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <article>
                    </article>
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">&lsaquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&rsaquo;</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </section>
            </div>
           
    </main>
  @endsection