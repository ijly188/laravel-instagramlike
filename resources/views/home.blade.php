@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://instagram.ftpe7-2.fna.fbcdn.net/vp/29356f393202074a0d44c112c3c7c276/5E17F3C8/t51.2885-19/s320x320/22709172_932712323559405_7810049005848625152_n.jpg?_nc_ht=instagram.ftpe7-2.fna.fbcdn.net" alt="" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div>
                <h1>freecodecamp</h1>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>153</strong> posts</div>
                <div class="pr-5"><strong>23k</strong> followers</div>
                <div class="pr-5"><strong>212</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">
                freeCodeCamp.org
            </div>
            <div>We're a global community of millions of people learning to code together. We're an open source, donor-supported, 501(c)(3) nonprofit.</div>
            <div><a href="#">www.freecodecamp.org</a></div>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-4">
            <img src="https://instagram.ftpe7-3.fna.fbcdn.net/vp/7eec6d7be4cbe5a2ff171f3e9d8497b1/5E2B9DE5/t51.2885-15/e35/c97.0.556.556a/56744758_379573665990554_4212823596187171289_n.jpg?_nc_ht=instagram.ftpe7-3.fna.fbcdn.net&_nc_cat=102" alt="" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://instagram.ftpe7-3.fna.fbcdn.net/vp/7eec6d7be4cbe5a2ff171f3e9d8497b1/5E2B9DE5/t51.2885-15/e35/c97.0.556.556a/56744758_379573665990554_4212823596187171289_n.jpg?_nc_ht=instagram.ftpe7-3.fna.fbcdn.net&_nc_cat=102" alt="" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://instagram.ftpe7-3.fna.fbcdn.net/vp/7eec6d7be4cbe5a2ff171f3e9d8497b1/5E2B9DE5/t51.2885-15/e35/c97.0.556.556a/56744758_379573665990554_4212823596187171289_n.jpg?_nc_ht=instagram.ftpe7-3.fna.fbcdn.net&_nc_cat=102" alt="" class="w-100">
        </div>
    </div>
</div>
@endsection
