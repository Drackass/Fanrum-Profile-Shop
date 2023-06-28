<section class="s-admin-panel">
            <div class="admin-panel-page">
                <div class="header-admin-panel">
                    <h1> Nombre d'éléments: <?php echo GlobalVariables::$nbTuples?></h1>
                    <a href="" class="add-tuple"><i class='bx bx-add-to-queue'></i></a>
                </div>
                <hr>
                <div class="product-search-bar">
                    <button type="submit" class="btn-search"><i class='bx bx-search'></i></button>
                    
                    <input type="text" placeholder="Search..." id="search" name="search">
                </div>
                
                <div class="DGV">
    
                    
                    <table>
                        <thead>
                            <tr>
                    <?php foreach (GlobalVariables::$theFields as $field) : ?>
                        <th><?php echo $field; ?></th>
                        <?php endforeach; ?>
                        <th colspan="2"><i class='bx bxs-data'></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (GlobalVariables::$theOccurrences as $occurrence) : ?>
                        <tr>
                            <?php foreach ($occurrence as $value) : ?>
                                <td><?php echo $value; ?></td>
                                <?php endforeach; ?>
                                <td class="table-action"><a href="index.php?controleur=Admin&action=deleteOccurence&table=<?php echo GlobalVariables::$theTable?>&id="><i class='bx bxs-trash'></i></a></td>
                                <td class="table-action"><a href="index.php?controleur=Admin&action=deleteOccurence&table=<?php echo GlobalVariables::$theTable?>"><i class='bx bxs-edit'></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </section>