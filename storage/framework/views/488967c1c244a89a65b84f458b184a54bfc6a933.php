
<?php $__env->startSection('title', 'Add Program'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <h1 class="col">Creating New Program</h1>
        </div>
        <div class="row">

            <div class="col">
                <form action="<?php echo e(route('lecturer.program.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label >Name: </label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <div>
                            <label class="d-inline-block">Client: </label>
                            <button type="button" name="new" id="new" class="btn btn-success d-inline-block">Add New Client</button>
                            <button type="button" name="load" id="load" class="btn btn-primary d-inline-block">Add Existing Clients</button>
                        </div>
                        <div id="dynamic_field">


                        </div>
                    </div>
                    <div class="form-group">
                        <label >Description:</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label >Goal: </label>
                        <input type="text" class="form-control" name="goal" required>
                    </div>
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="created_by" value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->id); ?>">
                    <div class="form-group">
                        <label>Program Date / Deadline:</label>
                        <input type="date" class="form-control" name="program_date" required>
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select name="category" class="custom-select">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type:</label>
                        <select name="type" class="custom-select">
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div>
                            <label class="d-inline-block">Committee: </label>
                            <button type="button" name="new" id="addCommittee" class="btn btn-success d-inline-block">Add Committee</button>
                        </div>
                        <div id="committee_field">
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Thumbnail:</label>
                        <input type="file" class="form-control-file" name="thumbnail" title="thumbnail program" accept="image/x-png,image/gif,image/jpeg" />
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btnA circular greenstar font-weight-bold p-2 green-hover">Add Program</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            var i=1;
            var u=1;
            $('#new').click(function(){
                i++;
                $('#dynamic_field').append('<div id="row'+i+'"> <input type="text" class="form-control mt-3 d-inline-block newClientForm mr-3" name="newClient[]" placeholder="New client name" required>' +
                    '<input type="text" class="form-control mt-3 d-inline-block newClientForm mr-3" name="phone[]" placeholder="Phone Number" required>' +
                    '<input type="text" class="form-control mt-3 d-inline-block newClientForm mr-3" name="address[]" placeholder="Client Address" required>' +
                    '<input type="text" class="form-control mt-3 d-inline-block newClientForm mr-3" name="email[]" placeholder="Email Client" required>' +
                    '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove mb-1">X</button></div>');
            });

            $('#load').click(function(){
                i++;
                $('#dynamic_field').append('<div id="row'+i+'"> ' +
                    '<select name="client[]" class="custom-select mt-3 mr-3 d-inline-block clientForm">\n' +
                    '                                    <option hidden>Load Existing Client</option>\n' +
                    '                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                                    <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>\n' +
                    '                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                            </select>' +
                    ' <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove mt-3">X</button></div>');

                $('select').on('change', function(event ) {
                    var prevValue = $(this).data('previous');
                    $('select').not(this).find('option[value="'+prevValue+'"]').show();
                    var value = $(this).val();
                    $(this).data('previous',value); $('select').not(this).find('option[value="'+value+'"]').hide();
                });
            });

            $('#addCommittee').click(function(){
                u++;
                $('#committee_field').append('<div id="row'+u+'"> ' +
                    '<select name="committee[]" class="custom-select mt-3 mr-3 d-inline-block clientForm">\n' +
                    '                                    <option hidden>Add Committee</option>\n' +
                    '                                <?php $__currentLoopData = $committees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                                    <option value="<?php echo e($committee->id); ?>"><?php echo e($committee->identity->name); ?></option>\n' +
                    '                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>\n' +
                    '                            </select>' +
                    ' <button type="button" name="remove" id="'+u+'" class="btn btn-danger btn_remove mt-3">X</button></div>');

                $('select').on('change', function(event ) {
                    var prevValue = $(this).data('previous');
                    $('select').not(this).find('option[value="'+prevValue+'"]').show();
                    var value = $(this).val();
                    $(this).data('previous',value); $('select').not(this).find('option[value="'+value+'"]').hide();
                });
            });


            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            // $('#submit').click(function(){
            //     $.ajax({
            //         url:"name.php",
            //         method:"POST",
            //         data:$('#add_name').serialize(),
            //         success:function(data)
            //         {
            //             alert(data);
            //             $('#add_name')[0].reset();
            //         }
            //     });
            // });

        });

    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\uctcweb\resources\views/2ndRoleBlades/addProgram.blade.php ENDPATH**/ ?>