<form action="{{route('employees.update', ['employee_id' => $e->id])}}" method="POST">
    @csrf
    {{ method_field('PATCH') }}

    <div class="form-group">
        <label for="password">user id</label>
        <input name="user_id" id="password" class="form-control form-control-rounded" type="text" value="{{ $e->user_id }}">
    </div>
    <div class="form-group">
        <label for="password">login id</label>
        <input name="login_id" id="password" class="form-control form-control-rounded" type="text" value="{{ $e->login_id }}" >
    </div>
    <div class="form-group">
        <label for="password">people id</label>
        <input name="person_id" id="password" class="form-control form-control-rounded" type="text" value="{{ $e->person_id }}">
    </div>
        <div class="form-group">
            <label for="username">new_full_name</label>
            <input name="full_name" id="username" class="form-control form-control-rounded" type="text" value="{{ $e->name }}">
        </div>
        <div class="form-group">
            <label for="password">new_username</label>
            <input name="username" id="password" class="form-control form-control-rounded" type="text" value="{{ $e->username }}">
        </div>
        
        <div class="form-group">
            <label for="password">new_password</label>
            <input name="password" id="password" class="form-control form-control-rounded" type="text" >
        </div>
        <div class="form-group">
            <label for="password">re_password</label>
            <input name="re_password" id="password" class="form-control form-control-rounded" type="text">
        </div>
        <div class="form-group">
            <label for="password">new_email</label>
            <input name="email" id="password" class="form-control form-control-rounded" type="text" value="{{ $e->email }}">
        </div>
        <div class="form-group">
            <label for="password">new_phone</label>
            <input name="phone" id="password" class="form-control form-control-rounded" type="text" value="{{ $e->phone }}">
        </div>
        <div class="form-group">
            <label for="password">role_id</label>
            <input name="role_id" id="password" class="form-control form-control-rounded" type="number" value="{{ $e->role_id }}">
        </div>
        <div class="form-group">
            <label for="password">branch_id</label>
            <input name="branch_id" id="password" class="form-control form-control-rounded" type="number" value="{{ $e->branch_id }}">
        </div>
        @if ($errors->all())
            <span class="invalid-feedback">
                <strong>{{ $errors->first() }}</strong>
            </span>
        @endif
        <br>
        
        <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">create employees</button>
    </form>

    <form action="{{ url('employees/'.$e->id) }}" method="POST">
        @csrf
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-danger">Xóa</button>
    </form>