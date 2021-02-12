<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>Metronic | Login Page 1</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->


    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{asset("/css")}}/login-1.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset("/css")}}/plugins.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="{{asset("/")}}assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("/css")}}/style.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{asset("/")}}assets/media/logos/favicon.ico"/>

</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled sidebar-enabled page-loading">

<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside header-->
                <a href="#" class="text-center mb-10">
                    <img src="{{asset("/")}}assets/media/logos/logo-letter-1.png" class="max-h-70px" alt=""/>
                </a>
                <!--end::Aside header-->

                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                    Ön Muhasebe Sistemi<br/>
                </h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->

            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                 style="background-image: url({{asset("/media/login")}}/login-visual-1.svg)"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->

        <!--begin::Content-->
        <div
            class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form login-signin">
                    <!--begin::Form-->
                    <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg text-center">Hoş
                                Geldiniz</h3>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <!--begin::Title-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text"
                                   name="email" value="{{ old('email') }}" autocomplete="off"/>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label class="font-size-h6 font-weight-bolder text-dark pt-5">Şifre</label>

                                <a href="javascript:;"
                                   class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"
                                   id="kt_login_forgot">
                                    Şifremi Unuttum
                                </a>
                            </div>

                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" id="password"
                                   type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   autocomplete="off"/>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <!--end::Form group-->

                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">
                            <input type="submit"
                                   class="btn w-100 btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3"
                                   value=" Giriş Yap"/>

                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->

                <!--begin::Signup-->
                <div class="login-form login-signup">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                        <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your
                                account</p>
                        </div>
                        <!--end::Title-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                   type="text" placeholder="Fullname" name="fullname" autocomplete="off"/>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                   type="email" placeholder="Email" name="email" autocomplete="off"/>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                   type="password" placeholder="Password" name="password" autocomplete="off"/>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                   type="password" placeholder="Confirm password" name="cpassword" autocomplete="off"/>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="checkbox mb-0">
                                <input type="checkbox" name="agree"/>I Agree the <a href="#">terms and conditions</a>.
                                <span></span>
                            </label>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                            <button type="button" id="kt_login_signup_submit"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit
                            </button>
                            <button type="button" id="kt_login_signup_cancel"
                                    class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel
                            </button>
                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signup-->

                <!--begin::Forgot-->
                <div class="login-form login-forgot">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                        <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Şifremi Unttum</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Şifrenizi sıfırlamak için mail
                                adresninizi giriniz</p>
                        </div>
                        <!--end::Title-->

                        <!--begin::Form group-->
                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                   type="email" placeholder="Email" name="email" autocomplete="off"/>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap pb-lg-0">
                            <button type="button" id="kt_login_forgot_submit"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit
                            </button>
                            <button type="button" id="kt_login_forgot_cancel"
                                    class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel
                            </button>
                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Forgot-->
            </div>
            <!--end::Content body-->

        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->


<script src="{{asset("/js")}}/plugins.bundle.js?v=7.0.6"></script>
</body>
<!--end::Body-->
</html>
