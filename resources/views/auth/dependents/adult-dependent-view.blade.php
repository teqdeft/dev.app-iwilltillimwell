<div class="row personal-info-value-box">
                        <div class="col-md-12 grid-margin stretch-card dependent-detail-v1">
                            <div class="card theme-border-0">
                                <div class="card-body px-0 pt-0">

                                    <div class="detail-title">
                                        <p>This dependent is over the age of 18. Below is the email address associated with their account.</p>
                                    </div>

                                    <div class="detail-collapse">
                                        <a data-toggle="collapse"
                                           href="#collapseGuardian-{{ $dependent->id }}"
                                           role="button"
                                           aria-expanded="false"
                                           aria-controls="collapseGuardian-{{ $dependent->id }}">
                                            <i class="fas fa-leaf"></i>
                                            I am the legal guardian for this adult dependent and would like to manage their care.
                                        </a>
                                    </div>

                                    <div class="collapse" id="collapseGuardian-{{ $dependent->id }}">
                                        <div class="card mt-3">
                                            <div class="blockquote blockquote-primary">
                                                <div class="block-content">
                                                    <p>To manage care for an adult dependent under your guardianship we would need either a COURT-SIGNED
                                                        <span>Legal Proof of Guardianship</span> or a
                                                        <span>Durable Power of Attorney for Healthcare.</span>
                                                    </p>
                                                    <p>Please fax all required documents to <span>210-963-8780</span> including a Cover Sheet with the following information:</p>
                                                </div>
                                                <div class="contnt-ul">
                                                    <ul>
                                                        <li><span>ATTN:</span> Privacy and Compliance Team</li>
                                                        <li><span>SUBJECT:</span> Care management approval for adult dependent</li>
                                                        <li><span>PRIMARY:</span> {{ ucfirst($user->fname) }} {{ ucfirst($user->lname) }} (ID: {{ $user->id }})</li>
                                                        <li><span>ADULT DEPENDENT:</span> [DEPENDENT LEGAL NAME. MUST MATCH THE NAME IN THE COMPANION LEGAL DOCUMENTS]</li>
                                                    </ul>
                                                </div>
                                                <div class="block-detail-footer">
                                                    <p>Please allow up to 5 business days for your case to be reviewed and approved by our compliance team.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 relac-records-for">

                                        {{-- Relationship Form --}}
                                        <div class="form-inline user-name-form">
                                            <div class="form-group">
                                                <div class="rel-content rel_rel_jon">
                                                    <div class="rel-title"><h3>Relationship to</h3></div>
                                                    <div class="rel-text">
                                                        <p>{{ ucfirst($user->fname) }} {{ ucfirst($user->lname) }}</p>
                                                    </div>
                                                </div>
                                                <div class="rel-form">
                                                    <form class="form-group"
                                                          id="update-relationship-{{ $dependent->id }}"
                                                          method="POST"
                                                          action="{{ route('update.relatioship', $dependent->id) }}">
                                                        @csrf
                                                        <div class="select-box-and-button">
                                                            <select class="form-control theme-select" name="relationship">
                                                                @foreach (config('constants.relationship') as $key => $relation)
                                                                    <option value="{{ $key }}"
                                                                            @selected($key == ($dependent->relationship ?? ''))>
                                                                        {{ $relation }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <button type="submit" class="btn btn-primary mb-0">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Resend Registration Email --}}
                                        <div class="form-inline resend-and-change">
                                            <div class="resend-form">
                                                <form class="form-group"
                                                      id="resend-register-email-{{ $dependent->id }}"
                                                      method="POST"
                                                      action="{{ route('resend.dependent.email', $dependent->id) }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="w-100 d-block">Email:</label>
                                                        <div class="email-text-box mr-3">
                                                            <div class="inner-text-email-box">
                                                                <p>{{ $dependent->email }}</p>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mb-0">
                                                            Resend Registration Email
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                            @include('auth.dependent-email-update')
                                        </div>

                                        {{-- Status Update --}}
                                        <div class="form-inline update-status">
                                            <form class="form-group"
                                                  id="update-user-status-{{ $dependent->id }}"
                                                  method="POST"
                                                  action="{{ route('update.status', $dependent->id) }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="w-100 d-block">Status</label>
                                                    <div class="status-box mr-3">
                                                        <div class="inner-status-box">
                                                            <select class="form-control theme-select" name="status">
                                                                @foreach (config('constants.user_status') as $key => $status)
                                                                    <option value="{{ $key }}"
                                                                            @selected($key == $dependent->status)>
                                                                        {{ $status }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mb-0">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>{{-- /.relac-records-for --}}
                                </div>
                            </div>
                        </div>
                    </div>