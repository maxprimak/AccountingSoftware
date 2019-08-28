<form action="/employees" method="POST">
    @csrf
        <div class="form-group">
            <label for="username">new_full_name</label>
            <input name="new_full_name" id="username" class="form-control form-control-rounded" type="text">
        </div>
        <div class="form-group">
            <label for="password">new_username</label>
            <input name="new_username" id="password" class="form-control form-control-rounded" value="{{ old('new_username') }}" type="text">
        </div>
        
        <div class="form-group">
            <label for="password">new_password</label>
            <input name="new_password" id="password" class="form-control form-control-rounded" type="text">
        </div>
        <div class="form-group">
            <label for="password">re_password</label>
            <input name="re_password" id="password" class="form-control form-control-rounded" type="text">
        </div>
        <div class="form-group">
            <label for="password">new_email</label>
            <input name="new_email" id="password" class="form-control form-control-rounded" type="text">
        </div>
        <div class="form-group">
            <label for="password">new_phone</label>
            <input name="new_phone" id="password" class="form-control form-control-rounded" type="text">
        </div>
        <div class="form-group">
            <label for="password">role_id</label>
            <input name="role_id" id="password" class="form-control form-control-rounded" type="number">
        </div>
        <div class="form-group">
            <label for="password">branch_id</label>
            <input name="branch_id" id="password" class="form-control form-control-rounded" type="number">
        </div>

        @if ($errors->all())
            <span class="invalid-feedback">
                <strong>{{ $errors->first() }}</strong>
            </span>
        @endif

        <br>
        
        <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">create employees</button>
    </form>