<div class="row">

                          <!-- seo 1 -->
                          <div class="col-md-12">
                            <div class="item-container">
                              <h4>Gateway SEO</h4>
                              <div class="form-group">
                                <label class="field-required">Meta Title</label>
                                <input type="text" class="form-control" value="<?php echo e($packagesData->meta_title); ?>" name="meta_title" placeholder="Title" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Description</label>
                                <input type="text" class="form-control" value="<?php echo e($packagesData->meta_desc); ?>" name="meta_desc" placeholder="Description" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keyword" placeholder="Keywords"><?php echo e($packagesData->meta_keyword); ?></textarea>
                              </div>
                            </div>
                          </div>

                          <!-- seo 2 -->
                          <div class="col-md-12">
                            <div class="item-container">
                              <h4>RTA SEO</h4>
                              <div class="form-group">
                                <label class="field-required">Meta Title</label>
                                <input type="text" class="form-control" name="rapidex_meta_title" placeholder="Title" value="<?php echo e($packagesData->rapidex_meta_title); ?>" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Description</label>
                                <input type="text" class="form-control" name="rapidex_meta_desc" placeholder="Description" value="<?php echo e($packagesData->rapidex_meta_desc); ?>" />
                              </div>
                              <div class="form-group">
                                <label class="field-required">Meta Keywords</label>
                                <textarea class="form-control" name="rapidex_meta_keyword" placeholder="Keywords"><?php echo e($packagesData->rapidex_meta_keyword); ?></textarea>
                              </div>
                            </div>
                          </div>

                        </div>