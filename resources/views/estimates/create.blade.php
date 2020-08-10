<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create New Estimate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="estimates/company/create">
            <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="client" class="font-weight-bolder text-muted col-form-label">{{__('Client')}}</label>
                            @if(count($clients))
                                <select name="client" class="select2 form-control">
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}" title="">{{$client->first_name}} {{$client->last_name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-muted">No users to link</p>
                            @endif
                            <a class="float-right" href="/clients">Create new client</a>
                        </div>
                        <div class="col-6">
                            <label for="DueDate" class="font-weight-bolder text-muted col-form-label">{{__('Due Date')}}</label>
                            <input type="date" autocomplete="due_date"
                                   class="form-control"
                                   name="due_date" value="{{old('due_date')}}"
                                   required autofocus>


                            @error('DueDate')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="title" class="font-weight-bolder text-muted col-form-label">{{__('Title (optional)')}}</label>
                            <input type="text" autocomplete="title"
                                   class="form-control"
                                   name="title" value="{{old('title')}}"
                                   autofocus>


                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="color" class="font-weight-bolder text-muted col-form-label">{{__('Color')}}</label>
                            <input type="color" autocomplete="color"
                                   class="form-control"
                                   name="color" value="#0000A0"
                                   required autofocus>


                            @error('color')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <a class="new-product" href="#">+ Add new product</a>
                        <table class=" border-bottom border-top order-table">
                            <tr class="border-bottom text-secondary order-table-header" style="box-shadow: none !important; font-weight: normal">
                                <th class="order">Amount</th>
                                <th class="order">Description</th>
                                <th class="order">Price</th>
                                <th class="order">Tax</th>
                                <th class="order">Total</th>
                            </tr>
                            <tbody class="product" id="order-table">
                            <tr id="table-rows">
                                <th scope="row">
                                    <input id="amount1" type="number" autocomplete="amount"
                                           class="form-control product copy" min="1"
                                           name="amount1" value="{{old('amount')}}"
                                           required autofocus>
                                </th>
                                <td>
                                    <input type="text" autocomplete="description"
                                           class="form-control copy"
                                           name="description1" value="{{old('description')}}"
                                           required autofocus>
                                </td>
                                <td>
                                    <input id="price1" type="number" autocomplete="price"
                                           class="form-control product copy"
                                           name="price1" value="{{old('price')}}"
                                           min="0.00" step="0.01" placeholder="0.00"
                                           required autofocus>
                                </td>
                                <td>
                                    <select id="vat1" name="vat1" class="form-control product copy">
                                        <option value="21">21% full VAT</option>
                                        <option value="9">9% lowered VAT</option>
                                        <option value="0">0% no VAT</option>
                                    </select>
                                </td>
                                <th class="copy" id="total1">€0.00</th>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                <div class="row col-12">
                    <div class="w-100">
                        <div class="float-right">
                        <label for="client" class="font-weight-bolder text-muted col-form-label">{{__('Discount %')}}</label>
                        <input type="number" id="discount" autocomplete="discount"
                               class="form-control product" min="0"
                               name="discount" value="0"
                               required autofocus>
                        </div>
                    </div>
                </div>

                <div class="row col-12">
                    <div class="w-100 text-secondary">
                        <div id="discount-price" class="float-right">
                            0% Discount -€0.00
                        </div>
                    </div>
                </div>

                <div class="row col-12">
                    <div class="w-100 text-secondary">
                        <div id="subtotal" class="float-right">
                             Subtotal €0.00
                        </div>
                    </div>
                </div>


            </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <div class="w-100 text-secondary">
                            <div id="total" class="float-right">
                                total €0.00
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total_items" id="total_items" value="1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right w-25">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

