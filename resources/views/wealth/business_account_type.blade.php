                                                        <div class="account_typeJs tab-inner-text d-flex flex-wrap">
                                                            <input type="hidden" name="business[{{$business_item_key}}][account_types][{{$account_type_item_key ?? 0}}][account_type_id]" value="{{ isset($account_type_item->id) ? $account_type_item->id : '' }}">
                                                            <div class="formAreahalf basic_data">
                                                                <label class="form-label">Account
                                                                    Type {{($account_type_item_key ?? 0) + 1}} </label>
                                                                <select name="business[{{$business_item_key}}][account_types][{{$account_type_item_key ?? 0}}][account_type]" class="form-control accountTypesJs">
                                                                    <option value="" selected disabled>Choose Account Type
                                                                    </option>
                                                                    <option
                                                                        value="Insurance"{{ isset($account_type_item->account_type) && $account_type_item->account_type == 'Insurance' ? 'selected' : '' }}>
                                                                        Insurance</option>
                                                                    <option value="Investment"
                                                                        {{ isset($account_type_item->account_type) && $account_type_item->account_type == 'Investment' ? 'selected' : '' }}>
                                                                        Investment</option>
                                                                    <option value="Others"
                                                                        {{ isset($account_type_item->account_type) && $account_type_item->account_type == 'Others' ? 'selected' : '' }}>
                                                                        Others</option>
                                                                </select>
                                                            </div>
                                                            <div class="formAreahalf basic_data">
                                                                <label  class="form-label">Account/Policy Number {{($account_type_item_key ?? 0) + 1}}</label>
                                                                <input type="text" name="business[{{$business_item_key}}][account_types][{{$account_type_item_key ?? 0}}][policy_number]"
                                                                    value="@isset($account_type_item->policy_number) {{ $account_type_item->policy_number }} @endisset"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="formAreahalf basic_data accountTypeOtherJs" style="display:none;margin-bottom:40px;">
                                                                <label  class="form-label">Others, please specify {{($account_type_item_key ?? 0) + 1}}</label>
                                                                <input type="text" class="form-control"
                                                                            name="business[{{$business_item_key}}][account_types][{{$account_type_item_key ?? 0}}][other]"
                                                                            value="{{ isset($account_type_item->other) ? $account_type_item->other : '' }}">
                                                            </div>
                                                        </div>