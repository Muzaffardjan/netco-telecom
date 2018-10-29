<?php
/**
 * Тестовая задача для Netco telecom.
 *
 * @author  Muzaffardjan Karaev
 * @link    https://karaev.uz
 * Created: 28.10.2018 / 16:39
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Class Manufacturer
 * @package App\Models
 * @property $locale
 * @property $unique_name
 * @property $name
 * @property $image
 * @property $status
 * @property $created_at
 * @property $updated_at
 */
class Manufacturer extends Model
{
    /**
     * @var string
     */
    protected $table = 'manufacturers';

    protected $fillable = [
        'locale',
        'unique_name',
        'name',
        'image',
        'status'
    ];

    public function getById($id)
    {
        return parent::on()->findOrFail($id);
    }

    public function getAll()
    {
        return parent::all();
    }

    protected function getImageName(string $name)
    {
        $name = strtolower($name);

        $char_map = [
            /** Number */
            '0' => 'zero', '1' => 'pne', '2' => 'two', '3' => 'three', '4' => 'four',
            '5' => 'five', '6' => 'sex', '7' => 'seven', '8' => 'eight', '9' => 'nine',
            /** Russian */
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh',
            'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            /** Uzbek */
            "ў" => "o", "ғ" => "g", "ҳ" => "h", "қ" => "q",
        ];

        /** Transliterate characters to ASCII */
        $name = str_replace(array_keys($char_map), $char_map, $name);

        /** Replace non-alphanumeric characters with our delimiter */
        $name = preg_replace('/[^\p{L}\p{Nd}]+/u', '_', $name);

        /** Remove duplicate delimiters */
        $name = preg_replace('/(' . preg_quote('_', '/') . '){2,}/', '$1', $name);

        /** Truncate slug to max. characters */
        $name = mb_substr($name, 0, mb_strlen($name, 'UTF-8'), 'UTF-8');

        /** Remove delimiter from ends */
        $name = trim($name, '_');

        return $name;
    }

    public function saveData(Request $request)
    {
        $data = $request->all();

        /**
         * @var UploadedFile $image
         */
        $image = $request->file('image');

        $img = $this->getImageName($data['name']) . '.' . $image->getClientOriginalExtension();

        $this->locale = config('app.fallback_locale');
        $this->unique_name = $this->getImageName($data['name']);
        $this->name = $data['name'];
        $this->image = $img;
        $this->status = 'active';

        parent::save();

        // Moving file when saved manufacturer
        $image->move(public_path('/storage/manufacturer'), $img);
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getUniqueName()
    {
        return $this->unique_name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
