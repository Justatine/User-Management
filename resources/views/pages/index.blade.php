@extends('components.app-layout')

@section('title', 'Home Page')

@section('content')
    <div class="bg-gray-100">
        <div class="mx-auto sm:w-full lg:w-3/4">
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
    
                <div class="w-full lg:p-8 sm:p-0">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4">User Management System</h2>
                        <p>
                            Our User Management System is designed to streamline the process of managing users efficiently. 
                            It allows administrators to:
                        </p>
                        <ul class="list-disc list-inside mt-2">
                            <li>Create, update, and delete user accounts.</li>
                            <li>Assign roles and permissions for secure access control.</li>
                            <li>Track user activity logs for accountability and monitoring.</li>
                            <li>Integrate authentication via email, social logins, and 2FA.</li>
                        </ul>
                        <p class="mt-4">
                            This system ensures scalability and security while providing an intuitive interface for easy management.
                        </p>
                    </div>
                </div>
    
                <div class="w-full lg:p-8 sm:p-0">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4">Tech Stack</h2>
                        <p>
                            Our application leverages a modern tech stack to deliver high performance and maintainability. 
                            Here’s what we use:
                        </p>
                        <ul class="list-disc list-inside mt-2">
                            <li><strong>Docker:</strong> Containerized environments for consistent development and deployment.</li>
                            <li><strong>Laravel:</strong> A robust PHP framework for building scalable backends.</li>
                            <li><strong>Tailwind CSS:</strong> A utility-first CSS framework for fast and responsive designs.</li>
                            <li><strong>Flowbite:</strong> Prebuilt components for UI consistency and productivity.</li>
                            <li><strong>Alpine.js:</strong> Lightweight JavaScript framework for interactive frontend behavior.</li>
                            <li><strong>Vite:</strong> Modern build tool for lightning-fast development.</li>
                        </ul>
                        <p class="mt-4">
                            This stack ensures a seamless development workflow and exceptional user experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection