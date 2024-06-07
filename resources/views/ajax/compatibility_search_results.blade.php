@forelse ($compatibility as $comp => $val)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <div>
                                                <p class="text-muted fw-bolder mb-1 d-flex align-items-center lh-1"><span>{{ ucwords(trans($val->motherboardSpec->product_spec_name)) }}</span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <div>
                                                <p class="text-muted fw-bolder mb-1 d-flex align-items-center lh-1"><span>{{ ucwords(trans($val->cpuSpec->product_spec_name)) }}</span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start">
                                            <div>
                                                <p class="text-muted fw-bolder mb-1 d-flex align-items-center lh-1"><span>{{ ucwords(trans($val->ramSpec->product_spec_name)) }}</span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                                id="dropdownOrder-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-line"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown" aria-labelledby="dropdownOrder-0">
                                                <li><a class="dropdown-item" href="{{ route('compatibility.show', $val->id) }}">Edit</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <p class="text-white">No compatibility in database</p>
                                @endforelse