<!--Main layout-->
<main class="pt-5">
    <div id="container" class="container mt-5">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <span class="blue-text font-weight-bold">Admin Panel</span>
                    <span>/</span>
                    <span>Gestione categorie</span>

                </h4>
            </div>

        </div>
        <!-- Heading -->
        <div class="row wow fadeIn">
            <div class="col-md-12">
                <br>
                <div class="card" id="aggiungi-categoria">
                    <div class="card-header"><h3 class="h3-responsive">Aggiungi categoria</h3></div>
                    <div class="card-body">

                        <?php if (count($GLOBALS["NOTIFIER"]->getNotifications())): ?>
                            <!-- Write notifications -->
                            <br>
                            <?php foreach ($GLOBALS["NOTIFIER"]->getNotifications() as $notification): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $notification ?>
                                </div>
                            <?php endforeach; ?>

                            <?php $GLOBALS["NOTIFIER"]->clear(); ?>
                        <?php endif; ?>

                        <form class="form" method="post" action="/api/category/add">

                            <!-- Category name -->
                            <div class="md-form">
                                <input type="text" id="nomeCategoria" class="form-control" name="categoryName" required>
                                <label for="nomeCategoria">Nome categoria<span class="red-text">*</span></label>
                            </div>

                            <!-- Category desciption
                            <div class="md-form">
                                <input type="text" id="descrizioneCategoria" name="categoryDescription" class="form-control">
                                <label for="descrizioneCategoria">Descrizione categoria</label>
                            </div>
                            -->
                            <!-- Category desciption -->
                            <div class="md-form">
                                <textarea id="descrizioneCategoria" name="categoryDescription"
                                          class="form-control md-textarea" length="1024" rows="3"></textarea>

                                <!--
                                <input type="text" id="descrizioneCategoriaModal" name="categoryDescription" class="form-control">
                                -->

                                <label for="descrizioneCategoria">Descrizione categoria</label>
                            </div>

                            <div class="md-form">
                                <h4 class="h4-responsive">Immagine di categoria</h4>
                                <select id="imageSelector" name="categoryImagePath" class="browser-default custom-select">
                                    <?php foreach(CategoriesModel::getCategoryImages() as $imagePath):?>
                                        <option value="<?php echo $imagePath?>"><?php echo basename($imagePath)?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Add category button -->
                            <button class="btn btn-success btn-block my-4" type="submit">Aggiungi categoria</button>
                            <br>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="row wow fadeIn">
            <div class="col-md-12">
                <br>
                <div class="card" id="aggiungi-categoria">
                    <div class="card-header"><h3 class="h3-responsive">Carica immagine di copertina</h3></div>
                    <div class="card-body">
                        <!-- Upload image -->
                        <form class="form" method="post" action="/api/image/upload" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="category_image_upload" id="categoryImageUploadInput"
                                           aria-describedby="categoryImageUploadInput" accept="image/*">
                                    <label class="custom-file-label" for="categoryImageUploadInput">Scegli immagine</label>
                                </div>
                            </div>
                            <!-- Add category button -->
                            <button class="btn btn-cyan btn-block my-4" type="submit">Carica immagine</button>
                            <br>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <br>
        <!--Grid row-->
        <div class="row wow fadeIn">
            <div class="col-md-12">

                <div class="card" id="categorie">
                    <div class="card-header"><h3 class="h3-responsive">Categorie</h3></div>
                    <div class="card-body">
                        <?php if (count($categories) > 0): ?>
                            <table id="categoriesTable" class="table-striped table-responsive" width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome categoria</th>
                                    <th scope="col">Numero episodi</th>
                                    <th scope="col">Descrizione</th>
                                    <th scope="col">Path immagine</th>
                                    <th scope="col">Data creazione</th>
                                    <th scope="col">Ultima modifica</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td scope="row"><?php echo $category->getCategoryId(); ?></td>
                                        <td id="categoryName<?php echo $category->getCategoryId(); ?>"><?php echo $category->getCategoryName(); ?></td>
                                        <td><?php echo EpisodeModel::countEpisodesFromCategory($category->getCategoryId()) ?></td>
                                        <td id="categoryDescription<?php echo $category->getCategoryId(); ?>"><?php echo $category->getCategoryDescription(); ?></td>
                                        <td id="categoryPath<?php echo $category->getCategoryId(); ?>"><?php echo $category->getCategoryImagePath(); ?></td>
                                        <td><?php echo $category->getCategoryCreationDate(); ?></td>
                                        <td><?php echo $category->getCategoryLastEditDate(); ?></td>

                                        <td>
                                            <button class="btn btn-blue-grey edit-category-button"
                                                    category-target="<?php echo $category->getCategoryId(); ?>">
                                                Modifica
                                            </button>

                                            <button class="btn btn-danger delete-category-button" data-toggle="modal"
                                                    data-target="#modalConfirmDelete" category-target="<?php echo $category->getCategoryId(); ?>">
                                                Elimina
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <h3 class="h3-responsive">Non ci sono categorie.</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modals -->

        <!--Modal: modalConfirmDelete-->
        <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalEliminaMessaggio"
             aria-hidden="true">
            <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                <!--Content-->
                <div class="modal-content text-center">
                    <!--Header-->
                    <div class="modal-header d-flex justify-content-center">
                        <p class="heading" id="modalEliminaMessaggio">INSERT MESSAGE HERE</p>
                    </div>

                    <!--Body-->
                    <div class="modal-body">

                        <i class="fas fa-times fa-4x animated rotateIn"></i>

                    </div>

                    <!--Footer-->
                    <div class="modal-footer flex-center">
                        <a href="emptylink.com" id="eliminaButton" btn btn-outline-danger">Si</a>
                        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!--Modal: modalConfirmDelete-->

        <!--Modal: editCategory -->
        <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modifica categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="modalUpdateForm" class="form" method="post">
                            <!-- Category name -->
                            <div class="md-form">
                                <input type="text" id="nomeCategoriaModal" class="form-control" name="categoryName" required>
                                <label for="nomeCategoriaModal">Nome categoria<span class="red-text">*</span></label>
                            </div>

                            <!-- Category desciption -->
                            <div class="md-form">
                                <textarea id="descrizioneCategoriaModal" name="categoryDescription" class="form-control md-textarea" length="1024" rows="3"></textarea>
                                <!--
                                <input type="text" id="descrizioneCategoriaModal" name="categoryDescription" class="form-control">
                                -->
                                <label for="descrizioneCategoriaModal">Descrizione categoria</label>
                            </div>

                            <div class="md-form">
                                <h4 class="h4-responsive">Immagine di categoria</h4>
                                <select id="imageSelectorModal" name="categoryImagePath" class="browser-default custom-select">
                                    <?php foreach(CategoriesModel::getCategoryImages() as $imagePath):?>
                                        <option value="<?php echo $imagePath?>"><?php echo basename($imagePath)?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annulla</button>
                        <button id="submitSalvaModificheModal" type="button" class="btn btn-primary">Salva modifiche</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal: editCategory -->



        <footer>
            <!--Copyright-->
            <div class="footer-copyright py-3">
                © 2019 Copyright:
                <a href="https://chiassotv.ch/" rel="noreferrer" target="_blank"><?php echo APP_NAME ?></a>
            </div>
            <!--/.Copyright-->

        </footer>
        <!--/.Footer-->
    </div>
</main>

<!-- Modal manager -->
<script type="text/javascript" src="/application/assets/js/admin/categories/modalmanager.js"></script>

<!-- DataTables.js -->
<script src="/application/assets/js/addons/datatables.min.js"></script>
<script>
    //TODO: CHECK HERE
    $(document).ready(function () {
        $("#categoriesTable").dataTable({
            responsive: true,
        })
    })
</script>