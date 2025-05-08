<?php include '../controller/inventoryController.php'; ?>

<head>
    <title>Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/inventory.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="container my-3">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 header">
            <!-- Search Bar -->
            <div class="d-flex align-items-center gap-2" role="search">
                <input id="searchInput" class="form-control me-2 col-12 search-input" type="search" placeholder="Search parts, brands, stocks,...." aria-label="Search">
                <button class="btn btn-primary d-flex align-items-center gap-1" type="button" onclick="filterTable()">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>

            <!-- Add Parts Button -->
            <button type="button" class="btn btn-primary col-2" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Parts
            </button>
        </div>

        <div class="mt-2">
            <!-- Success and Error Messages -->
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show mx-auto text-center" role="alert">
                    <i class="bi bi-check-circle-fill"></i> <?= htmlspecialchars($success_message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show mx-auto text-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($error_message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>

        <!--TABLE NG INVENTORY--->
        <?php if (empty($parts)): ?>
            <div class="text-center p-4">
                <p class="mb-0">No parts available</p>
            </div>

        <?php else: ?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Part Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Stocks</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parts as $part): ?>
                        <tr>
                            <td><?= htmlspecialchars($part['part_name']); ?></td>
                            <td><?= htmlspecialchars($part['brand']); ?></td>
                            <td><?= htmlspecialchars($part['stocks']); ?></td>
                            <td>₱ <?= htmlspecialchars($part['cost'], 2); ?></td>
                            <td><?= htmlspecialchars($part['supplier']); ?></td>

                            <td>
                                <button class="btn btn-warning btn-sm edit-button" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-part-id="<?= $part['id'] ?>"
                                    data-part-name="<?= htmlspecialchars($part['part_name']); ?>"
                                    data-brand="<?= htmlspecialchars($part['brand']); ?>"
                                    data-stocks="<?= htmlspecialchars($part['stocks']); ?>"
                                    data-cost="<?= htmlspecialchars($part['cost']); ?>"
                                    data-supplier="<?= htmlspecialchars($part['supplier']); ?>">
                                    Edit</button>

                                <button class="btn btn-danger btn-sm delete-button" data-part-id="<?= $part['id']; ?>">Delete</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addModal">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controller/inventoryController.php" method="POST">
                            <label for="part_name" class="form-label">Part name</label>
                            <input type="text" name="part_name" class="form-control" required>

                            <label for="Brand" class="form-label">Brand</label>
                            <select name="brand" id="brand" class="form-control" required>
                                <option value="" disabled selected>Select brand</option>
                                <option value="Apple">Apple</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Xiaomi">Xiaomi</option>
                                <option value="Huawei">Huawei</option>
                                <option value="Oppo">Oppo</option>
                                <option value="Vivo">Vivo</option>
                                <option value="Realme">Realme</option>
                                <option value="OEM">OEM</option>
                                <option value="Other">Other</option>
                            </select>

                            <label for="stocks" class="form-label">Stocks</label>
                            <input type="number" name="stocks" class="form-control" min="0" required>

                            <label for="cost" class="form-label">Cost</label>
                            <input type="number" name="cost" class="form-control" step="0.01" required>

                            <label for="supplier" class="form-label">Supplier</label>
                            <input type="text" name="supplier" class="form-control" required>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="add_inventory">Add inventory</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="../controller/inventoryController.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModal">Edit Part</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="id" id="edit-id">

                            <label for="edit-part_name" class="form-label">Part Name</label>
                            <input type="text" name="part_name" id="edit-part-name" class="form-control" required>

                            <label for="edit-brand" class="form-label">Brand</label>
                            <select name="brand" id="edit-brand" class="form-control" required>
                                <option value="Apple">Apple</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Xiaomi">Xiaomi</option>
                                <option value="Huawei">Huawei</option>
                                <option value="Oppo">Oppo</option>
                                <option value="Vivo">Vivo</option>
                                <option value="Realme">Realme</option>
                                <option value="OEM">OEM</option>
                                <option value="Other">Other</option>
                            </select>

                            <label for="edit-stocks" class="form-label">Stocks</label>
                            <input type="number" name="stocks" id="edit-stocks" class="form-control" required>

                            <label for="edit-cost" class="form-label">Cost</label>Battery
                            Batteries

                            <input type="number" name="cost" id="edit-cost" class="form-control" step="0.01" required>

                            <label for="edit-supplier" class="form-label">Supplier</label>
                            <input type="text" name="supplier" id="edit-supplier" class="form-control" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="edit_inventory">Update Inventory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../assets/js/inventory.js"></script>
</body>