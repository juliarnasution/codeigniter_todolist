<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Todo List</h2>
                    <div>
                        <a href="<?php echo site_url('todo/add'); ?>" class="btn btn-primary">Add Todo</a>
                        <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
                    </div>
                </div>
                
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($todos as $todo): ?>
                            <tr>
                                <td><?php echo $todo->title; ?></td>
                                <td><?php echo $todo->description; ?></td>
                                <td><?php echo $todo->status; ?></td>
                                <td>
                                    <?php if($todo->status == 'pending'): ?>
                                        <a href="<?php echo site_url('todo/complete/'.$todo->id); ?>" class="btn btn-success btn-sm">Complete</a>
                                    <?php endif; ?>
                                    <a href="<?php echo site_url('todo/edit/'.$todo->id); ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="<?php echo site_url('todo/delete/'.$todo->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>