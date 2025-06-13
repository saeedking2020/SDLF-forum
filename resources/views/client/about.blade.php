@extends('layouts.app')
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="ms-md-2 ms-lg-5 display-6 fw-bold text-center">About the project</h2>
                </div>
                <div class="col-md-12 my-3">
                    <div>
                        This is a complete example of a forum website. SDLF stands for Saeed Doozandeh Laravel Forum. It
                        can be updated gradually. In this
                        project, I have tried to show every aspect
                        of a website in laravel, including CRUD, pagination, connecting to Telegram and sending
                        messages, notifications, privileges and access for each user, admins and clients, writing
                        comments, replying to posts, showing online users, profile for each user and updating them, like
                        and dislike posts and give ranking to users in addition to being able to search based on the
                        intended column. &nbsp
                        This project has been developed with the latest version of laravel (12) and mysql has been used
                        for its database.
                        <br><br>

                        <strong>To run the project:</strong>
                        <ol>
                            <li>Clone the project from github and extract it.</li>
                            <li>Run it in an IDE, e.g. phpstorm or VSCode.</li>
                            <li>Run "php artisan migrate" to create the database and transfer all the necessary tables
                                to
                                database.(if it doesn't work, create the database in phpmyadmin.)
                            </li>
                            <li>Run "php artisan db:seed" to seed the database with the default data to run a complete
                                forum
                                website.
                            </li>
                        </ol>
                        <strong>Default username and password with admin privileges) username: admin@admin.com password: admin@admin.com</strong>
                        <br>
                        This project can be further developed according to the customer's demand.
                        <br><br>
                        Developed by <strong>Saeed Doozandeh</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center gx-4">
                <div class="col-md-4 d-flex justify-content-center">
                    <img class="rounded-3"
                         src="{{asset('images/profile.jfif')}}" alt="Author's image">
                </div>
                <div class="col-md-8 my-3">
                    <h2 class="display-6 fw-bold">About Me</h2>
                    <p class="lead">Hi! I'm Saeed Doozandeh, a passionate web developer with a strong interest in
                        building clean,
                        efficient, and user-friendly applications. I specialize in PHP and Laravel, and I'm constantly
                        learning new technologies to expand my skill set. I enjoy working on both the backend and
                        frontend of web projects, and I'm committed to writing maintainable, scalable code. This
                        <strong>SDLF Forum</strong>
                        project is one of many sample applications I’ve developed to practice and demonstrate my skills
                        in Laravel, and I'm excited to keep growing as a developer through hands-on experience and
                        continuous learning.</p>
                    <p>Contact: <a href="mailto:saeed.doozandehce91@gmail.com">saeed.doozandehce91@gmail.com</a> | <a
                            href="https://www.linkedin.com/in/saeeddoozandeh/" target="_blank">LinkedIn</a> | <a
                            href="https://github.com/saeedking2020" target="_blank">GitHub</a> | <a
                            href="https://drive.google.com/file/d/1tQtEb1Hj5s7a4cdMPL761XShu5F75po8/view?usp=drive_link"
                            download>Resume</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
