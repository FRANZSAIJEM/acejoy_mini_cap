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


                color: #FFF; /* White text */
            ">
                <i class="fas fa-fish"></i> Dupa Fish Shop
            </h1>
        </div>


        <div class="p-3" style="

            font-size: 20px;


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

                <br>
                <div class="d-flex flex-wrap justify-content-between">
                    @foreach ($logEntries as $logEntry)
                        <div class="p-3 rounded-lg shadow-lg"
                            style="margin-bottom: 30px;
                                width: 400px;
                                background-color: #1E90FF; /* Ocean Blue background color */
                                color: #FFF; /* White text color */
                                border: 2px solid #008080; /* Teal border */
                                position: relative;
                                overflow: hidden;">
                            <div style="position: absolute; top: -30px; left: 50%; transform: translateX(-50%); background-color: #008080; padding: 10px; border-radius: 50%;">
                                <i class="fas fa-fish" style="color: #FFF; font-size: 30px;"></i>
                            </div> <br> <br>
                            <h5 style="color: #ffffff; /* White header color */">
                                {{$logEntry->log_entry}}
                            </h5>

                        </div>
                    @endforeach
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
<style>
    /* Initial style for the entries */
    .entry {
        transform: translateX(-100%);
        opacity: 0;
        transition: transform 0.5s, opacity 0.5s;
    }

    /* Animation style for the entries when 'animated-page' class is applied */
    .animated-page .entry {
        transform: translateX(0);
        opacity: 1;
    }

    /* Add a transition for the 'animated-page' class to smooth the animation */
    .animated-page .entry {
        transition: transform 0.5s, opacity 0.5s;
    }

</style>
<script>
    // Add the 'animated-page' class to the parent container when the page is visited
    document.addEventListener('DOMContentLoaded', function() {
        const pageContainer = document.querySelector('.animated-page');
        pageContainer.classList.add('animated-page');
    });
</script>

@endsection
@auth

@endauth

