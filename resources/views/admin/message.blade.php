<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        body {
            background-color: black;
            color: white;
        }

        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }

        .table_deg {
            border: 2px solid white;
            width: 100%;
            margin: auto;
            text-align: center;
        }

        .th_deg {
            background-color: skyblue;
            padding: 10px;
            
        }

        .img_size {
            width: 200px;
            height: 100px;
        }

        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            color: #fff;
            background-color: #138496;
            border-color: #117a8b;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Ajouter un espace entre les lignes du tableau */
        .table_deg td,
        .table_deg th {
            line-height: 3.5;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <h1 class="title_deg">All Messages</h1>
            <table class="table_deg">
                <tr class="th_deg">
                    <th style="padding:10px;">User ID</th>
                    <th style="padding:10px;">Name</th>
                    <th style="padding:10px;">Email</th>
                    <th style="padding:10px;">Phone</th>
                    <th style="padding:10px;">Message</th>
                    <th style="padding:10px;">Repondre</th>
                    <th style="padding:10px;">Supprimer</th>
                </tr>
                @foreach($contact as $contact)
                    <tr>
                        <td>{{ $contact->user_id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>
                            <a href="{{ url('send_email_message', $contact->id) }}" class="btn btn-info">Send Email</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Are you sure you want to delete this message?')"
                               class="btn btn-danger" href="{{ url('delete_message', $contact->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
