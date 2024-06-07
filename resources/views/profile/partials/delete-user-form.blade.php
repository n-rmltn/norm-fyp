<section>
        <div class="card mb-4">
            <div class="card-header justify-content-between align-items-center d-flex">
                <h6 class="card-title m-0">{{ __('Delete Account') }}</h6><br>
            </div>
            <div class="card-body">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">{{('Delete Account') }}</button>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <form method="post" action="{{ route('profile.destroy', $user->id) }}" id="deleteUserForm" class="p-6">
                @csrf
                @method('delete')
                <input type="hidden" name="user_id" id="deleteUserId">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('Are you sure you want to delete this account?') }}</h5>
                            </div>
                            <div class="modal-body">
                                {{ __('Once this account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete this account.') }}
                                <div class="mb-3">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="form-label mt-3 sr-only"  />
                                    <x-text-input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}" />
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDelete">{{ __('Delete Account') }}</button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('confirmDelete').addEventListener('click', function() {
            document.getElementById('deleteUserForm').submit();
        });
    });
</script>
</script>
</section>
