    <?php
    require_once 'database.php';
    require_once 'beverages.php';

    class BeveragesRepository extends Database
    {
        // Lấy tất cả các đồ uống
        function getAllBeverages()
        {
            // 1. Câu lệnh truy vấn để lấy tất cả dữ liệu từ bảng beverages
            $sql = "SELECT * FROM `beverages`";

            // 2. Chuẩn bị câu truy vấn (giúp chống SQL Injection)
            $stmt = self::$connection->prepare($sql);

            // 3. Thực thi truy vấn
            $stmt->execute();

            // 4. Lấy toàn bộ kết quả dưới dạng mảng kết hợp (associative array)
            $items = array();
            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // 5. Tạo danh sách các đối tượng Beverages từ dữ liệu vừa lấy
            $list = array();

            // 6. Chuyển từng dòng dữ liệu thành đối tượng Beverages
            foreach ($items as $item) {
                $list[] = new Beverages($item['beverage_id'], $item['beverage_name'], $item['price'], $item['description'], $item['image'], $item['category_id']);
            }

            // 7. Trả về danh sách các đối tượng đồ uống
            return $list;
        }

        // Lấy ngẫu nhiên một số lượng đồ uống
        function getBeveragesRandom($limit)
        {
            $sql = "SELECT * FROM `beverages` ORDER BY RAND() LIMIT ?";
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param("i", $limit);
            $stmt->execute();
            $items = array();
            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $list = array();
            foreach ($items as $item) {
                $list[] = new Beverages($item['beverage_id'], $item['beverage_name'], $item['price'], $item['description'], $item['image'], $item['category_id']);
            }
            return $list;
        }

        // Lấy đồ uống theo category_id (loại đồ uống), ngẫu nhiên, giới hạn số lượng
        function getBeveragesByCategoryId($category_id, $limit)
        {
            $sql = "SELECT * FROM `beverages` WHERE `category_id` =  ? ORDER BY RAND() LIMIT ?";
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param('ii', $category_id, $limit);
            $stmt->execute();
            $items = array();
            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $list = array();
            foreach ($items as $item) {
                $list[] = new Beverages($item['beverage_id'], $item['beverage_name'], $item['price'], $item['description'], $item['image'], $item['category_id']);
            }
            return $list;
        }

        // Lấy thông tin chi tiết một đồ uống theo ID
        function getBeveragesByBeverageId($beverage_id)
        {
            $sql = "SELECT * FROM `beverages` WHERE `beverage_id` = ?";
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param('i', $beverage_id);
            $stmt->execute();
            $items = array();
            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $beverage = null;
            foreach ($items as $item) {
                $beverage = new Beverages($item['beverage_id'], $item['beverage_name'], $item['price'], $item['description'], $item['image'], $item['category_id']);
            }
            return $beverage;
        }

        // Thêm mới một đồ uống
        function addBeverages($beverages)
        {
            $sql = "INSERT INTO `beverages`(`beverage_name`,`price`,`description`,`image`,`category_id`) VALUES(?,?,?,?,?)";
            $stmt = self::$connection->prepare($sql);
            $beverage_name = $beverages->getBeverageName();
            $price =  $beverages->getPrice();
            $description = $beverages->getDescription();
            $image = $beverages->getImage();
            $category_id = $beverages->getCategoryId();
            $stmt->bind_param('sissi', $beverage_name, $price, $description, $image, $category_id);
            return $stmt->execute();
        }

        // Cập nhật thông tin một đồ uống
        function updateBeverages($beverages)
        {
            $sql = "UPDATE `beverages` SET `beverage_name` = ?, `price` = ?, `description` = ?, `image` = ?, `category_id` = ? WHERE `beverage_id` = ?";
            $stmt = self::$connection->prepare($sql);
            $beverage_name = $beverages->getBeverageName();
            $price =  $beverages->getPrice();
            $description = $beverages->getDescription();
            $image = $beverages->getImage();
            $category_id = $beverages->getCategoryId();
            $beverage_id = $beverages->getBeverageId();
            $stmt->bind_param('sissii',  $beverage_name, $price, $description, $image, $category_id, $beverage_id);
            return $stmt->execute();
        }

        // Xoá đồ uống theo ID
        function deleteBeverages($beverage_id)
        {
            $sql = "DELETE FROM `beverages` WHERE `beverage_id` = ?";
            $stmt = self::$connection->prepare($sql);
            $stmt->bind_param('i', $beverage_id);
            return $stmt->execute();
        }

        // Tìm kiếm đồ uống theo từ khóa tên
        function searchBeverages($key)
        {
            $sql = "SELECT * FROM `beverages` WHERE `beverages`.`beverage_name` LIKE ?";
            $stmt = self::$connection->prepare($sql);
            $key = "%" . $key . "%";
            $stmt->bind_param('s', $key);
            $stmt->execute();
            $items = array();
            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $list = array();
            foreach ($items as $item) {
                $list[] = new Beverages($item['beverage_id'], $item['beverage_name'], $item['price'], $item['description'], $item['image'], $item['category_id']);
            }
            return $list;
        }

        // Tìm kiếm có phân trang
        function searchBeveragesPage($key, $page, $perPage)
        {
            $start = ($page - 1) * $perPage;
            $sql = "SELECT * FROM `beverages` WHERE `beverages`.`beverage_name` LIKE ? ORDER BY RAND() LIMIT $start, $perPage";
            $stmt = self::$connection->prepare($sql);
            $key = "%" . $key . "%";
            $stmt->bind_param('s', $key);
            $stmt->execute();
            $items = array();
            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $list = array();
            foreach ($items as $item) {
                $list[] = new Beverages($item['beverage_id'], $item['beverage_name'], $item['price'], $item['description'], $item['image'], $item['category_id']);
            }
            return $list;
        }

        // Tạo liên kết phân trang khi tìm kiếm
        function createPageLinkSearchBeverages($total, $perPage, $currentPage, $key)
        {
            $totalLink = ceil($total / $perPage);
            $link = "";
            for ($i = 1; $i <= $totalLink; $i++) {
                $active = ($i == $currentPage) ? "active" : "";
                $link .= '<li class="page-item ' . $active . '"><a href="?page=' . $i . ' &key=' . $key . '" class="page-link">' . $i . '</a></li>';
            }
            return $link;
        }

        // Lấy tất cả đồ uống có phân trang
        function getAllBeveragesPage($page, $perPage)
        {
            $start = ($page - 1) * $perPage;
            $sql = "SELECT * FROM `beverages` LIMIT $start, $perPage";
            $stmt = self::$connection->prepare($sql);
            $stmt->execute();
            $items = array();
            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $list = array();
            foreach ($items as $item) {
                $list[] = new Beverages($item['beverage_id'], $item['beverage_name'], $item['price'], $item['description'], $item['image'], $item['category_id']);
            }
            return $list;
        }

        // Tạo liên kết phân trang
        function createPageLinkBeverages($total, $perPage, $currentPage)
        {
            $totalLink = ceil($total / $perPage);
            $link = "";
            for ($i = 1; $i <= $totalLink; $i++) {
                $active = ($i == $currentPage) ? "active" : "";
                $link .= '<li class="page-item ' . $active . '"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
            }
            return $link;
        }
    }
