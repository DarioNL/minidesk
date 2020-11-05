<div id="editModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Invoice @if($invoice->title != null){{$invoice->title}}@else{{$invoice->number}}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" @auth('admins') action="/admin/invoices/{{$invoice->id}}/edit"> @else action="/company/invoices/{{$invoice->id}}/edit"> @endauth
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="client" class="font-weight-bolder text-muted col-form-label">{{__('Client')}}</label>
                            @auth('admins') @php($clients = \App\Models\Client::all()) @endauth
                            @if(count($clients))
                                <select name="client" class="select2 form-control">
                                    @foreach($clients as $client)
                                        <option @if($invoice->client == $client->id) selected @endif value="{{$client->id}}" title="">{{$client->first_name}} {{$client->last_name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-muted">No users to link</p>
                            @endif
                            <a class="float-right" href="/clients">Create new client</a>
                        </div>
                        @php($dueDate = explode(' ', $invoice->due_date))
                        <div class="col-6">
                            <label for="DueDate" class="font-weight-bolder text-muted col-form-label">{{__('Due Date')}}</label>
                            <input type="date" autocomplete="due_date"
                                   class="form-control  @error('due_date') is-invalid @enderror"
                                   name="due_date" value="{{$dueDate[0]}}"
                                   required autofocus>


                            @error('due_date')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="title" class="font-weight-bolder text-muted col-form-label">{{__('Title (optional)')}}</label>
                            <input type="text" autocomplete="title"
                                   class="form-control  @error('title') is-invalid @enderror"
                                   name="title" value="{{$invoice->title}}"
                                   required autofocus>


                            @error('title')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @auth('admins')
                            <div class="col-6">
                                <label for="company" class="font-weight-bolder text-muted col-form-label">{{__('Company')}}</label>
                                @if(count($companies))
                                    <select name="company" class="form-control">
                                        @foreach($companies as $company)
                                            <option @if($company->id == $invoice->$company) selected @endif value="{{$company->id}}" title="">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <p class="text-muted">No companies to link</p>
                                @endif
                                <a class="float-right" href="/admin/companies">Create new company</a>
                            </div>
                        @endauth
                    </div>

                    @php($products = \App\Models\Products::all()->where('invoice_id', '=', $invoice->id))
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
                                <tbody id="order-table">
                                @php($i = 0)
                                @foreach($products as $product)
                                    @php($i++)
                                    <tr id="table-rows" class="product">
                                        <th scope="row">
                                            <input id="amount{{$i}}" type="number" autocomplete="amount"
                                                   class="form-control product copy" min="1"
                                                   name="amount{{$i}}" value="{{$product->amount}}"
                                                   required autofocus>
                                        </th>
                                        <td>
                                            <input type="text" autocomplete="description"
                                                   class="form-control copy"
                                                   name="description{{$i}}" value="{{$product->description}}"
                                                   required autofocus>
                                        </td>
                                        <td>
                                            <input id="price{{$i}}" type="number" autocomplete="price"
                                                   class="form-control product copy"
                                                   name="price{{$i}}" value="{{$product->price}}"
                                                   min="0.00" step="0.01" placeholder="0.00"
                                                   required autofocus>
                                        </td>
                                        <td>
                                            <select id="vat{{$i}}"  name="vat{{$i}}" class="form-control product copy">
                                                <option @if($product-> tax == 21) selected @endif value="21">21% full VAT</option>
                                                <option @if($product-> tax == 9) selected @endif value="9">9% lowered VAT</option>
                                                <option @if($product-> tax == 0) selected @endif value="0">0% no VAT</option>
                                            </select>
                                        </td>
                                        <th class="copy" id="total{{$i}}">€{{$product->total}}</th>
                                    </tr>
                                @endforeach
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
                                       name="discount" value="{{$invoice->discount}}"
                                       required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="w-100 text-secondary">
                            <div id="discount-price" class="float-right">
                                {{$invoice->discount}}% Discount -€{{$invoice->amount}}
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="w-100 text-secondary">
                            <div id="subtotal" class="float-right">
                                Subtotal €{{$invoice->total}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <div class="w-100 text-secondary">
                            <div id="total" class="float-right">
                                total €{{$invoice->total}}
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="total_items" id="total_items" value="{{$products->count()}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right w-25">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

