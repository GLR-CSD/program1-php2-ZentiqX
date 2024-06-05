<?php

class Album
{
    private ?int $id;
    private string $naam;
    private string $artiesten;
    private string $release_datum;
    private string $url;
    private string $afbeelding;
    private string $prijs;

    public function __construct(?int $id, string $naam, string $artiesten, string $release_datum, string $url, string $afbeelding, string $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->artiesten = $artiesten;
        $this->release_datum = $release_datum;
        $this->url = $url;
        $this->afbeelding = $afbeelding;
        $this->prijs = $prijs;
    }

    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM album");
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $albums[] = new Album(
                $row['id'],
                $row['naam'],
                $row['artiesten'],
                $row['release_datum'],
                $row['url'],
                $row['afbeelding'],
                $row['prijs']
            );
        }
        return $albums;
    }

    public function save(PDO $db): void
    {
        $stmt = $db->prepare("INSERT INTO album (naam, artiesten, release_datum, url, afbeelding, prijs) VALUES (:naam, :artiesten, :release_datum, :url, :afbeelding, :prijs)");
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':artiesten', $this->artiesten);
        $stmt->bindParam(':release_datum', $this->release_datum);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':afbeelding', $this->afbeelding);
        $stmt->bindParam(':prijs', $this->prijs);
        $stmt->execute();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getArtiesten(): string
    {
        return $this->artiesten;
    }

    public function getReleaseDatum(): string
    {
        return $this->release_datum;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getAfbeelding(): string
    {
        return $this->afbeelding;
    }

    public function getPrijs(): string
    {
        return $this->prijs;
    }
}
?>
