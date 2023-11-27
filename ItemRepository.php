<?php
class ItemRepository
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "postoffice");
        $this->mysqli->set_charset("utf8mb4");
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getAllCounties()
    {
        $counties = [];

        $sql = "SELECT * FROM counties";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $counties[] = $row;
            }
        }

        return $counties;
    }

    public function getCitiesByCountyId($countyId)
    {
        $cities = [];

        $sql = "SELECT * FROM cities WHERE id_county = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $countyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cities[] = $row;
            }
        }

        return $cities;
    }

    public function getCityById($cityId)
    {

        $sql = "SELECT * FROM cities WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $cityId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        else
        {
             return 'Postal code not available!';
        }
    }

    public function getCountyById($countyId)
    {

        $sql = "SELECT * FROM counties WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $countyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        else
        {
             return 'Postal code not available!';
        }
    }

    
    public function saveCity($name)
    {
        $sql = "INSERT INTO `cities`( `city`) VALUES ($name)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
    }

    public function updateCounty($countyId, $countyName) {
        $sql = 'UPDATE counties SET name = ? WHERE id = ?';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $countyName, $countyId);

        $stmt -> execute();
    }

    public function saveCounty($countyname)
    {
        $sql = "INSERT INTO Counties(name) VALUES (?)";
        $stmt = $this->mysqli->prepare($sql);
        $result = $this->mysqli->query($sql);

        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $counties[] = $row;
            }
        }
        return $counties;
    }

    public function searchCounty($needle) {
        $sql = "SELECT * FROM counties WHERE name LIKE = %?%";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $needle);

        $stmt->execute();
    }

    public function closeConnection()
    {
        $this->mysqli->close();
    }
}

