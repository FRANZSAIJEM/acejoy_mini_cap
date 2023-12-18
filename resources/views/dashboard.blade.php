@extends('base')

@section('content')
<div class="text-white">
    <header class="p-4" style="
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    background-color: #1E90FF; /* Ocean Blue */
    z-index: 1;
    position: fixed;
    width: 100%;
">
    <div class="d-flex justify-content-between">
        <div class="">
            <h1 class="p-3" style="


                border-radius: 12px; /* Rounded border */

                color: #FFF; /* White text */
            ">
                <i class="fas fa-fish"></i> Acejoy Fish Store
            </h1>
        </div>
        <div class="p-3" style="

            font-size: 20px;

            border-radius: 12px; /* Rounded border */

            color: #FFF; /* White text */
        ">
            <a class="btn text-white" href="/dashboard"><i class="fas fa-fish"></i> Ocean</a>
            @role('admin')
            <a class="btn text-white" href="/logs"><i class="fas fa-history"></i> Logs</a>
            @endrole
            <button
                data-toggle="modal" data-target="#confirmLogoutModal"
                class="text-white rounded-lg pe-4 ps-4 text-danger btn" style="background-color: transparent; font-size: 16px; border: none;">
                <i class="fas fa-fish"></i> {{ Auth::user()->name }}
            </button>
        </div>
    </div>
</header>



<div>
    <div class="p-5">
        <div style="margin-top: 100px;">
            <h1 class="d-flex text-white float-right" style="margin-top: 20px;">
                @role('admin')
                <button style="font-size: 20px;" type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal">
                    <span class="p-2 rounded-lg text-dark">

                        <i class="fas fa-fish"></i> Add Fish
                    </span>
                </button>
                @endrole
            </h1> <br> <br>
            <br>

            <div style="place-content: center;" class="d-flex flex-wrap">

                <div>
                    <table style="width: 1775px;" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Color</th>
                                <th>Habitat</th>
                                <th>Price</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plugins as $plugin)
                            <tr>
                                <td><h5>{{$plugin->name}}</h5></td>
                                <td><h5>{{$plugin->type}}</h5></td>
                                <td><h5>{{$plugin->color}}</h5></td>
                                <td><h5>{{$plugin->habitat}}</h5></td>
                                <td><h5>{{$plugin->price}}</h5></td>
                                <td>
                                    <form action="{{ route('plugin.download', $plugin) }}" method="POST">
                                        @csrf
                                        <div class="d-flex justify-content-center">
                                            @role('user')
                                            <button class="btn btn-primary" data-plugin-id="{{ $plugin->id }}" onclick="submitOrderForm(this)">
                                                <i class="fa fa-fish"></i> Buy Now
                                            </button>
                                            @endrole

                                        </div>
                                    </form>
                                    @role('admin')
                                    <button type="button" class="btn text-success" data-toggle="modal" data-target="#editModal-{{ $plugin->id }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn text-danger" data-toggle="modal" data-target="#deleteModal-{{ $plugin->id }}" data-plugin-id="{{ $plugin->id }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                    @endrole
                                </td>
                            </tr>
                                 <!-- Edit Fish Item Modal -->
<div id="editModal-{{ $plugin->id }}" class="modal fade" style="margin-top: 100px" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog text-white" role="document">
        <div class="modal-content" style="background-color: #1E90FF;"> <!-- Ocean Blue background color -->
            <div class="modal-header" style="border-bottom: 2px solid #4682B4;"> <!-- Darker Ocean Blue border -->
                <h5 class="modal-title" id="editModalLabel"><i class="fas fa-fish"></i> <b>Edit Fish Item</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm-{{ $plugin->id }}" method="POST" action="{{ route('plugins.update', $plugin) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name"><i class="fas fa-fish"></i> Fish Name:</label>
                        <input type="text" class="form-control bg-transparent text-white" id="name" name="name" value="{{ $plugin->name }}">
                    </div>

                    <div class="form-group">
                        <label for="price"><i class="fas fa-dollar-sign"></i> Price:</label>
                        <input type="text" class="form-control bg-transparent text-white" id="price" name="price" value="{{ $plugin->price }}">
                    </div>

                    <div class="form-group">
                        <label for="type"><i class="fas fa-fish"></i> Fish Type:</label>
                        <input type="text" class="form-control bg-transparent text-white" id="type" name="type" value="{{ $plugin->name }}">
                    </div>

                    <div class="form-group">
                        <label for="color"><i class="fas fa-palette"></i> Fish Color:</label>
                        <input type="text" class="form-control bg-transparent text-white" id="color" name="color" value="{{ $plugin->name }}">
                    </div>

                    <div class="form-group">
                        <label for="habitat"><i class="fas fa-map-marked-alt"></i> Habitat:</label>
                        <input type="text" class="form-control bg-transparent text-white" id="habitat" name="habitat" value="{{ $plugin->name }}">
                    </div>

                </form>
            </div>
            <div class="modal-footer" style="border-top: 2px solid #4682B4;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                <button type="submit" form="editForm-{{ $plugin->id }}" class="btn btn-secondary text-white"><i class="fas fa-save"></i> Save Changes</button>
            </div>
        </div>
    </div>
</div>



                          <!-- Fish-themed Delete Modal -->
<div id="deleteModal-{{ $plugin->id }}" class="modal fade" style="margin-top: 300px" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog text-white" role="document">
        <div class="modal-content" style="background-color: #1E90FF;"> <!-- Ocean Blue background color -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Fish Item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                <form id="deleteForm-{{ $plugin->id }}" method="POST" action="{{ route('plugins.destroy', $plugin) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>




                            @endforeach
                        </tbody>



                    </table>

                </div>

            </div>
        </div>
    </div>
</div>






</div>

<!-- Fish-themed Confirm Logout Modal -->
<div class="modal fade" style="margin-top: 300px" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-white" role="document">
        <div class="modal-content" style="background-color: #1E90FF;"> <!-- Ocean Blue background color -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-sign-out-alt"></i> Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Confirm Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Fish-themed Modal -->
<div class="modal fade" style="margin-top: 100px" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-white" style="background-color: #1E90FF; /* Ocean Blue background color */">
            <div class="modal-header" style="border-bottom: 2px solid #4682B4; /* Darker Ocean Blue border */">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-fish"></i> <b>Create Fish Item</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('plugins.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-fish"></i> Fish Name:</label>
                        <input type="text" name="name" id="name" class="form-control bg-transparent text-white" required>
                    </div>

                    <div class="form-group">
                        <label for="price"><i class="fas fa-dollar-sign"></i> Price:</label>
                        <input type="number" name="price" id="price" class="form-control bg-transparent text-white" required>
                    </div>

                    <div class="form-group">
                        <label for="type"><i class="fas fa-fish"></i> Fish Type:</label>
                        <input type="text" name="type" id="type" class="form-control bg-transparent text-white" required>
                    </div>

                    <div class="form-group">
                        <label for="color"><i class="fas fa-palette"></i> Fish Color:</label>
                        <input type="text" name="color" id="color" class="form-control bg-transparent text-white" required>
                    </div>

                    <div class="form-group">
                        <label for="habitat"><i class="fas fa-map-marked-alt"></i> Habitat:</label>
                        <input type="text" name="habitat" id="habitat" class="form-control bg-transparent text-white" required>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #4682B4; /* Darker Ocean Blue border */">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    .orderBtn{
        font-size: 20px;
        transition: 0.5s
    }
    .orderBtn:hover{
        font-size: 30px;
    }
     @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-20px);
        }
        60% {
            transform: translateY(-10px);
        }
    }

    .order-card h3 {
        animation: bounce 2s infinite; /* Adjust the animation duration as needed */
    }

     @keyframes fadeInFromLeft {
        from {
            opacity: 0;

        }
        to {
            opacity: 1;

        }
    }

    .order-card {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        z-index: 1000;
        animation: fadeInFromLeft 0.5s ease-out; /* Adjust the animation duration and easing as needed */
    }


     .m-5 {
        perspective: 1000px;
        transition: transform 0.5s;
    }

    .bg-secondary {
        border-radius: 20px;
        box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        transition: transform 0.5s;
    }

    .bg-secondary:hover {
        transform: rotateY(20deg);
    }

    .view-button {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.5s;
    }

    .m-5:hover .view-button {
        opacity: 1;
    }
    .software-checkboxes {
        display: flex;
        flex-direction: column;
        margin: 20px;
    }
    .form-check {
        display: flex;
        align-items: center;
    }
</style>
<script>
// Function to show the "Ordering Please Wait!" card and submit the form
function submitOrderForm(button) {
    var pluginId = button.getAttribute('data-plugin-id');
    var orderCard = document.getElementById('orderCard_' + pluginId);
    orderCard.style.display = 'block';

    // Submit the form after showing the card
    var orderForm = document.getElementById('orderForm_' + pluginId);
    orderForm.submit();
}


   function updateSelectedSoftware() {
        const checkboxes = document.querySelectorAll('input[name="software"]');
        const selectedSoftware = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedSoftware.push(checkbox.value);
            }
        });

        const selectedSoftwareInput = document.getElementById('daws');
        selectedSoftwareInput.value = selectedSoftware.join(', '); // or use any other delimiter you prefer
    }
</script>

@endsection
@auth

@endauth

