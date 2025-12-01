@extends('layout.layout')

@section('content')
<main class=" w-100 py-3">
    
    <div class="mx-auto w-50">
        <h3>Profile Settings</h3>
        <p class="text-muted">Manage your profile information and visibility</p>
        <div class="border border-1 rounded-4 p-3 mb-4">
            <h3>Basic Information</h3>
            <p class="text-muted">Update your personal information</p>
            <div class="d-flex align-items-center justify-content-start ">
                <figure style="width:64px; height:64px;" class="position-relative rounded-circle overflow-hidden mb-0 me-3">
                    <img src="{{ auth()->user()->image}}" alt="" class="object-fit-cover " width="64" height="64">
                </figure>
                <div class="d-grid gap-2">
                    <span class="fs-3">Lucas Gallardo</span>
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
        <h3>Privacy Settings</h3>
        <p class="text-muted">Manage who can see your content and how your information is useds</p>
        <div class="border border-1 rounded-4 p-3 mb-4">
            <header>
                <h3>Account Privacy</h3>
                <p class="text-muted">Control the privacy of your account</p>
            </header>
    
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Private account</span>
                    <span class="">When your account is private, only people you approve can see your posts and stories</span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="width: 50px; height:20px;">
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Activity status</span>
                    <span class="">Allow accounts you follow to see when you were last active</span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="width: 50px; height:20px;">
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Mentions</span>
                    <span class="">Control who can mention you in their posts</span>
                </div>
                <div class="form-check form-switch">
                    <select class="form-select" id="autoSizingSelect">
                        <option selected>Everyone</option>
                        <option value="1">People you follow</option>
                        <option value="2">No one</option>
                    </select>
                </div>
            </div>
            <footer class="d-flex justify-content-end border-top mt-3 pt-3">
                <button class="btn btn-primary">Save changes</button>
            </footer>
        </div>
        <div class="border border-1 rounded-4 p-3 mb-4">
            <header>
                <h3>Interactions</h3>
                <p class="text-muted">Manage who can interact with you and your content</p>
            </header>
    
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Comments</span>
                    <span class="">Choose who can comment on your posts</span>
                </div>
                <div class="form-check form-switch">
                    <select class="form-select" id="autoSizingSelect">
                        <option selected>Everyone</option>
                        <option value="1">People you follow</option>
                        <option value="2">No one</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Tags</span>
                    <span class="">Control who can tag you in their posts</span>
                </div>
                <div class="form-check form-switch">
                    <select class="form-select" id="autoSizingSelect">
                        <option selected>Everyone</option>
                        <option value="1">People you follow</option>
                        <option value="2">No one</option>
                    </select>
                </div>
            </div>
            <footer class="d-flex justify-content-end border-top mt-3 pt-3">
                <button class="btn btn-primary">Save changes</button>
            </footer>
        </div>
        <h3>Notifications Settings</h3>
        <p>Manage how and when you receive notifications</p>
        <nav class="nav nav-pills flex-column flex-sm-row my-3">
            <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Push</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="#">Email</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="#">SMS</a>
        </nav>
        <div class="border border-1 rounded-4 p-3 mb-4">
            <header>
                <h3>Push Notifications</h3>
                <p class="text-muted">Control which push notifications you receive on your devices</p>
            </header>
    
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Pause all notifications</span>
                    <span class="">Temporarily disable all push notifications</span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="width: 50px; height:20px;">
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Likes</span>
                    <span class="">When someone likes your post</span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="width: 50px; height:20px;">
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Comments</span>
                    <span class="">When someone comments on your post</span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="width: 50px; height:20px;">
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">New followers</span>
                    <span class="">When someone follows you</span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="width: 50px; height:20px;">
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-grid gap-1 me-3">
                    <span class="fw-bold">Mentions</span>
                    <span class="">When someone mentions you in a post</span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="width: 50px; height:20px;">
                </div>
            </div>
            <footer class="d-flex justify-content-end border-top mt-3 pt-3">
                <button class="btn btn-primary">Save changes</button>
            </footer>
        </div>

    </div>
</main>
@endsection