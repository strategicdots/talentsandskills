<form action="../control/candidate/profile.php" method="post" class="sm" id="cs-form">
    <input type="hidden" value="<?php echo $user->id; ?>" name="id">
    <input type="hidden" value="cs" name="profile_type">
    <div class="row">
        <div class="col-sm-6">

            <div class="form-group">
                <label class="txt-bold small-font-size capitalize">desired job title</label>
                <input type="text" class="form-control" value="<?php if(isset($desiredJob[0]->job_title)) {echo $desiredJob[0]->job_title; } else {echo "
                              "; } ?>" name="job_title" placeholder="enter your desired job title">
            </div>

            <div class="form-group">
                <label class="txt-bold small-font-size capitalize">job field</label>
                <select name="job_field" class="form-control">
                    <option value="">choose your field</option>
                    <?php $jobFields = JobFields::findAll(); 
                    foreach($jobFields as $job_field): ?>

                    <?php if($job_field->name == $desiredJob[0]->job_field ): ?>
                    <option value="<?php echo $job_field->name; ?>" selected><?php echo ucwords($job_field->name); ?></option>
                    <?php else : ?>
                    <option value="<?php echo $job_field->name; ?>"><?php echo ucwords($job_field->name); ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="txt-bold small-font-size capitalize">job type</label>
                <select name="job_type" class="form-control capitalize">
                    <?php foreach($jobType as $type) : 
                    if($type->time_span == $desiredJob[0]->job_type) : ?>
                    <option value="<?php echo $type->type; ?>" selected><?php echo $type->type; ?></option>

                    <?php else: ?>
                    <option value="<?php echo $type->type; ?>"><?php echo $type->type; ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </div>

        </div>
        <div class="col-sm-6 m-light-bottom-breather">

            <div class="form-group">
                <label class="txt-bold small-font-size capitalize">preferred salary</label>
                <select name="salary_range" class="form-control capitalize">

                    <?php foreach($salaryRange as $range):
                    if($range->salary_range == $desiredJob[0]->salary_range): ?>

                    <option value="<?php echo $range->salary_range; ?>" selected><?php echo $range->salary_range; ?></option>

                    <?php else: ?>
                    <option value="<?php echo $range->salary_range; ?>"><?php echo $range->salary_range; ?></option>

                    <?php endif; endforeach; ?>                                                    
                </select>
            </div>

            <div class="form-group">
                <label class="txt-bold small-font-size capitalize">desired job location</label>
                <select name="location" id="" class="form-control">
                    <option>desired job location</option>
                    <?php foreach($states as $state):

                    if($state->name == $desiredJob[0]->location): ?>
                    <option value="<?php echo $state->name; ?>" selected><?php echo $state->name; ?></option>
                    <?php else: ?>
                    <option value="<?php echo $state->name; ?>"><?php echo $state->name; ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </div>

        </div>
        <div class="sm-container m-vlight-breather">
            <div class="row">
                <div class="col-sm-8">
                    <input type="submit" value="Confirm Changes" name="submit" id="CS-pd" class="form-control btn sec-btn capitalize"></div>
                <div class="col-sm-4">
                    <button name="submit" class="form-control capitalize btn main-btn" id="ca-cs-f">cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>