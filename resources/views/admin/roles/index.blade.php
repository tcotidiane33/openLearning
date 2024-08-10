<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles and Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Create New Role</h3>
                    <form action="{{ route('admin.roles.create') }}" method="POST" class="mb-8">
                        @csrf
                        <div class="flex">
                            <input type="text" name="name" placeholder="Role Name" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                            <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md">Create Role</button>
                        </div>
                    </form>

                    <h3 class="text-lg font-semibold mb-4">Assign Permissions to Roles</h3>
                    @foreach($roles as $role)
                        <div class="mb-6">
                            <h4 class="text-md font-semibold mb-2">{{ $role->name }}</h4>
                            <form action="{{ route('admin.roles.assign-permissions', $role) }}" method="POST">
                                @csrf
                                @foreach($permissions as $permission)
                                    <label class="inline-flex items-center mt-3">
                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" name="permissions[]" value="{{ $permission->name }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                                <button type="submit" class="mt-4 px-4 py-2 bg-green-500 text-white rounded-md">Assign Permissions</button>
                            </form>
                        </div>
                    @endforeach

                    <h3 class="text-lg font-semibold mb-4">Assign Role to User</h3>
                    <form action="{{ route('admin.users.assign-role') }}" method="POST">
                        @csrf
                        <div class="flex">
                            <select name="user_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach(App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <select name="role" class="form-select rounded-md shadow-sm mt-1 block w-full ml-4" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md">Assign Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>